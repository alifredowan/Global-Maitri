<?php

namespace Tests\Feature;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\User;
use App\Models\WaliLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class MindfulChatAndChaperoneTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthorized_user_cannot_view_conversation(): void
    {
        $groom = User::factory()->create(['role' => 'seeker', 'gender' => 'male']);
        $bride = User::factory()->create(['role' => 'seeker', 'gender' => 'female']);
        $stranger = User::factory()->create(['role' => 'seeker', 'gender' => 'male']);

        $conversation = Conversation::create(['status' => 'active']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $groom->id, 'role' => 'participant']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $bride->id, 'role' => 'participant']);

        $this->actingAs($stranger);

        $response = $this->get(route('chat.show', $conversation->id));
        $response->assertRedirect(route('chat.index'));
        $response->assertSessionHas('error', 'You are not a participant in this conversation.');
    }

    public function test_contact_leak_and_dowry_screening_sanitizes_body_and_flags_message(): void
    {
        Notification::fake();

        $groom = User::factory()->create(['role' => 'seeker', 'gender' => 'male']);
        $bride = User::factory()->create(['role' => 'seeker', 'gender' => 'female']);

        $conversation = Conversation::create(['status' => 'active']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $groom->id, 'role' => 'participant']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $bride->id, 'role' => 'participant']);

        $this->actingAs($groom);

        // Send a message containing both an off-platform phone number and dowry demands
        $response = $this->post(route('chat.send', $conversation->id), [
            'body' => 'Please call me at +8801712345678 or reach me on WhatsApp. Also let us discuss dowry cash demand.',
        ]);

        $response->assertRedirect();

        $message = $conversation->messages()->latest()->first();
        $this->assertNotNull($message);
        $this->assertTrue((bool) $message->is_flagged);
        $this->assertStringContainsString('[Phone Number Hidden]', $message->body);
        $this->assertStringContainsString('[Prohibited Dowry Request Flagged]', $message->body);
        $this->assertStringNotContainsString('+8801712345678', $message->body);
    }

    public function test_script_only_html_tags_are_stripped_and_rejected(): void
    {
        $groom = User::factory()->create(['role' => 'seeker', 'gender' => 'male']);
        $bride = User::factory()->create(['role' => 'seeker', 'gender' => 'female']);

        $conversation = Conversation::create(['status' => 'active']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $groom->id, 'role' => 'participant']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $bride->id, 'role' => 'participant']);

        $this->actingAs($groom);

        // 1. Tag-only message (empty after tag stripping) is rejected
        $response = $this->post(route('chat.send', $conversation->id), [
            'body' => '<p><br></p>',
        ]);
        $response->assertSessionHasErrors('body');
        $this->assertEquals(0, $conversation->messages()->count());

        // 2. Message containing script tags has the script tags completely stripped
        $response2 = $this->post(route('chat.send', $conversation->id), [
            'body' => 'Hello <script>alert("xss")</script> there',
        ]);
        $response2->assertRedirect();
        $savedMessage = $conversation->messages()->latest()->first();
        $this->assertNotNull($savedMessage);
        $this->assertStringNotContainsString('<script>', $savedMessage->body);
        $this->assertStringNotContainsString('</script>', $savedMessage->body);
        $this->assertEquals('Hello alert("xss") there', $savedMessage->body);
    }

    public function test_chaperone_with_view_only_permission_cannot_send_messages(): void
    {
        $groom = User::factory()->create(['role' => 'seeker', 'gender' => 'male']);
        $bride = User::factory()->create(['role' => 'seeker', 'gender' => 'female']);
        $guardian = User::factory()->create(['role' => 'family_rep', 'gender' => 'male']);

        WaliLink::create([
            'seeker_user_id' => $bride->id,
            'wali_user_id' => $guardian->id,
            'relationship_type' => 'father',
            'permission_level' => 'view_only',
            'status' => 'active',
            'invite_token' => 'view-only-token',
        ]);

        $conversation = Conversation::create(['status' => 'active']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $groom->id, 'role' => 'participant']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $bride->id, 'role' => 'participant']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $guardian->id, 'role' => 'wali_chaperone']);

        $this->actingAs($guardian);

        $response = $this->post(route('chat.send', $conversation->id), [
            'body' => 'I am the chaperone checking in.',
        ]);

        $response->assertSessionHas('error', 'Your guardian permission is set to View Only.');
        $this->assertEquals(0, $conversation->messages()->count());
    }
}

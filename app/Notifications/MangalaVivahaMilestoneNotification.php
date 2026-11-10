<?php

namespace App\Notifications;

// Compatibility alias allowing both MangalaVivahaMilestoneNotification and NikahMilestoneNotification
if (! class_exists(MangalaVivahaMilestoneNotification::class, false)) {
    class_alias(NikahMilestoneNotification::class, MangalaVivahaMilestoneNotification::class);
}

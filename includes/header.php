<?php
/**
 * Header Component
 * Fixed header with navigation and status information
 */
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FlowGuard Pro - Dashboard</title>
    <link rel="stylesheet" href="assets/css/index.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body>

<!-- TopAppBar / Header -->
<header>
    <div class="header-left">
        <span class="header-logo">FLOWGUARD</span>
        <div class="header-divider"></div>
        <div class="header-status">
            <span class="status-dot"></span>
            <span class="status-text">Online</span>
        </div>
    </div>
    
    <div class="header-right">
        <div class="tank-selector">
            <span class="material-symbols-outlined" style="font-size: 18px;">water_drop</span>
            <span>Main Tank</span>
            <span class="material-symbols-outlined" style="font-size: 18px;">keyboard_arrow_down</span>
        </div>
        
        <div class="header-buttons">
            <button class="header-btn notification-btn" title="Notifications">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button class="header-btn theme-btn" title="Toggle Theme">
                <span class="material-symbols-outlined">dark_mode</span>
            </button>
            <img alt="AQUARIST PROFILE" class="profile-img" data-alt="A portrait of a professional aquarist with a focused and serene expression, set against a background of high-end aquarium technology. The lighting is soft and cinematic, with cool blue tones and subtle hints of neon cyan, reflecting the high-tech IoT aesthetic of the FlowGuard brand. The visual style is modern, minimalist, and deeply professional." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2DFQf41VMxyiYcjoDLmPy7Arjo-h7MqOH-b9AAFnQjYBRx8aA0DNblsgZTQSsQ0639SOhaCoVedDm3YuuGQN1CISAAFRK9A0yYAT9YLuy5SS5FqdbvBzYHvbKU5GQxj006HYqGFAaGqatEF6YnnERH1sUPZAW7bg3bEnDdl1fB89IQYlPKwjghPnDbUB7aBGzAsm6A4BqVolsLXck5ZGNfL9umtjmkylrCl0f44Pi8JTs4uGKowsCDGoNCRuIgSJOBS53fs6sfwo"/>
        </div>
    </div>
</header>

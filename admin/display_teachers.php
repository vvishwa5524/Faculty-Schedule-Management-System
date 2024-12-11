<?php
include 'connections.php'; // Include your DB connection
session_start();
// Fetch the list of teachers from the `teachers_list` table
$query = "SELECT user_id as ID, Name FROM teachers_list ORDER BY name";
$stmt = $pdo->prepare($query);
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Teachers</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/table_list.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased scroll-smooth bg-gray-200">
<div x-data="{ sidemenu: false }" class="h-screen flex overflow-hidden" x-cloak @keydown.window.escape="sidemenu = false">

<div class="md:hidden">
  <div @click="sidemenu = false" class="fixed inset-0 z-30 bg-gray-600 opacity-0 pointer-events-none transition-opacity ease-linear duration-300" :class="{'opacity-75 pointer-events-auto': sidemenu, 'opacity-0 pointer-events-none': !sidemenu}"></div>

  <!-- Small Screen Menu -->
  <div class="fixed inset-y-0 left-0 flex flex-col z-40 max-w-xs w-full bg-white transform ease-in-out duration-300 -translate-x-full" :class="{'translate-x-0': sidemenu, '-translate-x-full': !sidemenu}">

    <!-- Brand Logo / Name -->
    <div class="flex items-center px-6 py-3 h-16">
      <div class="text-2xl font-bold tracking-tight text-gray-800">TMS</div>
    </div>
    <!-- @end Brand Logo / Name -->
    <div class="px-4 py-2 flex-1 h-0 overflow-y-auto">
      <ul>
        <li>
          <a href="admin_dashboard.php" class="mb-1 px-2 py-2 rounded-lg hover:text-blue-600 flex items-center font-medium text-gray-700 hover:bg-gray-200 ">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <rect x="4" y="4" width="6" height="6" rx="1" />
              <rect x="14" y="4" width="6" height="6" rx="1" />
              <rect x="4" y="14" width="6" height="6" rx="1" />
              <rect x="14" y="14" width="6" height="6" rx="1" />
            </svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="display_teachers2.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-blue-700 hover:text-blue-600 hover:bg-gray-200 bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <line x1="4" y1="19" x2="20" y2="19" />
              <polyline points="4 15 8 9 12 11 16 6 20 10" />
            </svg>
            Overview
          </a>
        </li>
        <li>
          <a href="view_sch.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <polyline points="14 3 14 8 19 8" />
              <path d="M17 21H7a2 2 0 0 1 -2 -2V5a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
              <line x1="9" y1="9" x2="10" y2="9" />
              <line x1="9" y1="13" x2="15" y2="13" />
              <line x1="9" y1="17" x2="15" y2="17" />
            </svg>
            Schedule
          </a>
        </li>
        <li>
          <a href="view_att.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11.5" cy="8.5" r="5.5" />
              <path d="M11.5 14v7" />
            </svg>
            Attendance
          </a>
        </li>
        <li>
          <a href="new_find.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <path d="M16 6h3a 1 1 0 011 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
              <line x1="8" y1="8" x2="12" y2="8" />
              <line x1="8" y1="12" x2="12" y2="12" />
              <line x1="8" y1="16" x2="12" y2="16" />
            </svg>
            Empty Periods
          </a>
        </li>
        <li>
          <a href="send_message.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
            Message
          </a>
        </li>
        <li>
          <a href="admin_settings.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
            Settings
          </a>
        </li>
        <li>
          <a href="logout.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
            Log Out
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- @end Small Screen Menu -->
</div>
<!-- Menu Above Medium Screen -->
<div class="bg-white w-64 min-h-screen overflow-y-auto hidden md:block shadow relative z-30">
  <!-- Brand Logo / Name -->
  <div class="flex items-center px-6 py-3 h-16">
    <div class="text-2xl font-bold tracking-tight text-gray-800">TMS</div>
  </div>
  <!-- @end Brand Logo / Name -->
  <div class="px-4 py-2">
    <ul>
      <li>
        <a href="admin_dashboard.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-blue-600 hover:text-blue-600 hover:bg-gray-200 bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <rect x="4" y="4" width="6" height="6" rx="1" />
            <rect x="14" y="4" width="6" height="6" rx="1" />
            <rect x="4" y="14" width="6" height="6" rx="1" />
            <rect x="14" y="14" width="6" height="6" rx="1" />
          </svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="display_teachers2.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <line x1="4" y1="19" x2="20" y2="19" />
            <polyline points="4 15 8 9 12 11 16 6 20 10" />
          </svg>
         Overview
        </a>
      </li>
      <li>
        <a href="view_sch.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <polyline points="14 3 14 8 19 8" />
            <path d="M17 21H7a2 2 0 0 1 -2 -2V5a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
            <line x1="9" y1="9" x2="10" y2="9" />
            <line x1="9" y1="13" x2="15" y2="13" />
            <line x1="9" y1="17" x2="15" y2="17" />
          </svg>
          Schedule
        </a>
      </li>
      <li>
        <a href="view_att.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11.5" cy="8.5" r="5.5" />
            <path d="M11.5 14v7" />
          </svg>
         Attendance
        </a>
      </li>
      <li>
        <a href="new_find.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <path d="M16 6h3a 1 1 0 011 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
            <line x1="8" y1="8" x2="12" y2="8" />
            <line x1="8" y1="12" x2="12" y2="12" />
            <line x1="8" y1="16" x2="12" y2="16" />
          </svg>
          Empty Periods
        </a>
      </li>
      <li>
        <a href="send_message.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <circle cx="12" cy="12" r="3" />
          </svg>
          Message
        </a>
      </li>
      <li>
        <a href="admin_settings.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <circle cx="12" cy="12" r="3" />
          </svg>
         Settings
        </a>
      </li>
      <li>
        <a href="logout.php" class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 opacity-50" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <circle cx="12" cy="12" r="3" />
          </svg>
         Log Out
        </a>
      </li>
    </ul>
  </div>
</div>
<!-- @end Menu Above Medium Screen -->

<div class="flex-1 flex-col relative z-0 overflow-y-auto">
  <div class="px-4 md:px-8 py-2 h-16 flex justify-between items-center shadow-sm bg-white">
    <div class="flex items-center w-2/3">
      <input class="bg-gray-200 focus:outline-none focus:shadow-outline focus:bg-white border border-transparent focus:border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal hidden md:block placeholder-gray-700 mr-10" type="text" placeholder="Buscar...">

      <div class="p-2 rounded-full hover:bg-gray-200 cursor-pointer md:hidden" @click="sidemenu = !sidemenu">
        <svg class="text-gray-600 hover:text-blue-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
          <line x1="4" y1="6" x2="20" y2="6" />
          <line x1="4" y1="12" x2="20" y2="12" />
          <line x1="4" y1="18" x2="20" y2="18" />
        </svg>
      </div>
      <div class="text-xl font-bold tracking-tight text-gray-800 md:hidden ml-2">Dashboard</div>
    </div>
    <div class="flex items-center">

      <a class="relative p-2 text-gray-500 hover:bg-gray-200 hover:text-blue-600 mr-4 rounded-full cursor-pointer	">
        <span class="sr-only">Notifications</span>
        <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full"></span>
        <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full animate-ping"></span>
        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
      </a>

      <div class="relative" x-data="{ open: false }" x-cloak>
        <div @click="open = !open" class="cursor-pointer font-bold w-10 h-10 bg-blue-200 text-blue-400 hover:bg-blue-300 hover:text-blue-500 flex items-center justify-center rounded-full focus:ring-blue-500">
          IA
        </div>

        <div x-show.transition="open" @click.away="open = false" class="absolute top-0 mt-12 right-0 w-48 bg-white py-2 shadow-md border border-gray-100 rounded-lg z-40">
          <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600"><?="User Id ". $_SESSION['user_id']?></a>
          <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600"><?= $_SESSION['Name']?></a>
          <a href="logout.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Log Out</a>
        </div>
      </div>
    </div>
    <div>
        
    </div>
  </div>
  <h1>Admin - Teachers List</h1>

    <!-- Table to display teachers -->
    <div class="table-wrapper">
    <table class="fl-table">
        <thead>
            <th>User ID</th>
            <th>Name</th>
            <th>Actions</th>
            <th>Message</th>
        </thead>

        <?php if ($teachers): ?>
            <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?= htmlspecialchars($teacher['ID']) ?></td>
                    <td><?= htmlspecialchars($teacher['Name']) ?></td>
                    <td>
                        <a class="tag" href="view_schedule.php?user_id=<?= urlencode($teacher['ID']) ?>" >View Schedule</a><br>
                        <a href="view_attendance.php?user_id=<?= urlencode($teacher['ID']) ?>" class="tag">View Attendance</a>
                    </td>
                    <td>
                        <a href="send_message.php?user_id=<?= urlencode($teacher['ID']) ?>">Send Message</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No teachers found in the teachers list.</td>
            </tr>
        <?php endif; ?>
    </table>
    </div>
</div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
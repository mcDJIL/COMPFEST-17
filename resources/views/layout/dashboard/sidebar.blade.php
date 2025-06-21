<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      @if ($user->role === 'admin')
         <ul class="space-y-2 font-medium">
            <li>
               <a href="{{ route('dashboard.admin.index') }}" class="{{ Route::currentRouteName() === 'dashboard.admin.index' ? 'bg-gray-100 text-gray-900' : '' }} mb-1 hover:bg-gray-50 group-hover:text-gray-900 flex items-center p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                  <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                     <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                     <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                  </svg>
                  <span class="ms-3">Dashboard</span>
               </a>
            </li>
            <li>
               <a href="{{ route('dashboard.admin.profile') }}" class="{{ Route::currentRouteName() === 'dashboard.admin.profile' ? 'bg-gray-100 text-gray-900' : '' }} mb-1 hover:bg-gray-50 group-hover:text-gray-900 flex items-center p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                  <i class="fa-solid fa-user w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"></i>

                  <span class="ms-3">Profile</span>
               </a>
            </li>
         </ul>
      @else
         <ul>
            <li>
               <a href="{{ route('dashboard.user.index') }}" class="{{ Route::currentRouteName() === 'dashboard.user.index' ? 'bg-gray-100 text-gray-900' : '' }} mb-1 hover:bg-gray-50 group-hover:text-gray-900 flex items-center p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                  <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                     <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                     <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                  </svg>
                  <span class="ms-3">Dashboard</span>
               </a>
            </li>
            <li>
               <a href="{{ route('dashboard.user.profile') }}" class="{{ Route::currentRouteName() === 'dashboard.user.profile' ? 'bg-gray-100 text-gray-900' : '' }} mb-1 hover:bg-gray-50 group-hover:text-gray-900 flex items-center p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                  <i class="fa-solid fa-user w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"></i>
      
                  <span class="ms-3">Profile</span>
               </a>
            </li>
         </ul>
      @endif
   </div>
</aside>
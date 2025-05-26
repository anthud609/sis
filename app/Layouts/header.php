<!DOCTYPE html>
<html>
<head>
  <title>CSPlus Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  
  <style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    ::-webkit-scrollbar-track {
      background: transparent;
    }
    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(147, 51, 234, 0.3));
      border-radius: 10px;
      transition: all 0.3s ease;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.6), rgba(147, 51, 234, 0.6));
    }

    /* Command Palette Blur */
    .backdrop-blur-heavy {
      backdrop-filter: blur(40px);
    }

    /* Custom animations */
    @keyframes slide-down {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse-soft {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.7; }
    }

    @keyframes fade-in {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .animate-slide-down {
      animation: slide-down 0.3s ease-out;
    }

    .animate-pulse-soft {
      animation: pulse-soft 2s ease-in-out infinite;
    }

    .animate-fade-in {
      animation: fade-in 0.6s ease-out;
    }

    .hover-lift {
      transition: transform 0.2s ease-out;
    }

    .hover-lift:hover {
      transform: translateY(-2px);
    }

    .text-gradient {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Mobile sidebar overlay */
    .sidebar-overlay {
      backdrop-filter: blur(8px);
    }

    /* Body styling */
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
  <!-- Mobile Menu Button -->
  <button id="mobileMenuBtn" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
    <i class="fas fa-bars text-gray-600 dark:text-gray-300"></i>
  </button>

  <!-- Sidebar Overlay for Mobile -->
  <div id="sidebarOverlay" class="lg:hidden fixed inset-0 bg-black/50 sidebar-overlay z-40 hidden"></div>

  <!-- Sidebar -->
  <aside id="sidebar" class="fixed left-0 top-0 bottom-0 w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
    <!-- Sidebar Header -->
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
          <i class="fas fa-code text-white text-sm"></i>
        </div>
        <h2 class="font-bold text-xl text-gradient">CSPlus</h2>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 overflow-y-auto">
      <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
        <li>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
            <i class="fas fa-home text-blue-500 w-4"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <button
            aria-expanded="false"
            aria-controls="submenu-1"
            onclick="toggleMenu(event, 'submenu-1')"
            class="w-full flex justify-between items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
          >
            <div class="flex items-center gap-3">
              <i class="fas fa-folder text-amber-500 w-4"></i>
              <span>Projects</span>
            </div>
            <i class="fas fa-chevron-down transition-transform duration-200"></i>
          </button>
          <ul id="submenu-1" class="hidden pl-7 mt-1 space-y-1">
            <li>
              <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <i class="fas fa-circle text-xs text-green-500"></i>
                <span>Active Projects</span>
              </a>
            </li>
            <li>
              <button
                aria-expanded="false"
                aria-controls="submenu-1-1"
                onclick="toggleMenu(event, 'submenu-1-1')"
                class="w-full flex justify-between items-center px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
              >
                <div class="flex items-center gap-3">
                  <i class="fas fa-circle text-xs text-blue-500"></i>
                  <span>Archive</span>
                </div>
                <i class="fas fa-chevron-down transition-transform duration-200"></i>
              </button>
              <ul id="submenu-1-1" class="hidden pl-6 mt-1 space-y-1">
                <li>
                  <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <i class="fas fa-minus text-xs text-gray-400"></i>
                    <span>2024 Projects</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <i class="fas fa-minus text-xs text-gray-400"></i>
                    <span>2023 Projects</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
            <i class="fas fa-users text-purple-500 w-4"></i>
            <span>Team</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
            <i class="fas fa-chart-bar text-green-500 w-4"></i>
            <span>Analytics</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
            <i class="fas fa-cog text-gray-500 w-4"></i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
      <div class="flex items-center gap-3 mb-3">
        <img src="https://i.pravatar.cc/32" alt="User" class="w-8 h-8 rounded-lg object-cover" />
        <div class="flex-1 min-w-0">
          <div class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">John Doe</div>
          <div class="text-xs text-gray-500 dark:text-gray-400 truncate">john@company.com</div>
        </div>
      </div>
      <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
        <div class="flex items-center gap-2">
          <div class="w-2 h-2 rounded-full bg-green-500"></div>
          <span>Online</span>
        </div>
        <button class="hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </div>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="lg:ml-64 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="h-16 px-4 lg:px-8 flex items-center justify-between bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 relative z-30 shadow-sm">
      <div class="flex items-center gap-4 ml-12 lg:ml-0">
        <h1 class="text-xl lg:text-2xl font-bold text-gradient">Dashboard</h1>
        <div class="hidden md:flex items-center gap-2">
          <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse-soft"></div>
          <span class="text-sm text-slate-500 dark:text-slate-400">All systems operational</span>
        </div>
      </div>
      
      <div class="flex items-center gap-2 lg:gap-4">
        <!-- Search - Hidden on mobile -->
        <div class="relative group hidden md:block">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-search text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
          </div>
          <input
            type="text"
            placeholder="Search everything..."
            class="w-60 lg:w-80 pl-12 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:shadow-md"
          />
          <kbd class="absolute right-3 top-1/2 -translate-y-1/2 px-2 py-1 text-xs bg-gray-200 dark:bg-gray-600 rounded border text-slate-500 dark:text-slate-400">⌘K</kbd>
        </div>

        <!-- Mobile Search Button -->
        <button class="md:hidden p-2.5 rounded-xl bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-300 hover-lift shadow-sm" title="Search">
          <i class="fas fa-search text-slate-600 dark:text-slate-300"></i>
        </button>

        <!-- Notifications -->
        <button class="relative p-2.5 rounded-xl bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-300 hover-lift group shadow-sm" title="Notifications">
          <i class="fas fa-bell text-slate-600 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-blue-400"></i>
          <span class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-r from-red-500 to-pink-500 rounded-full text-xs text-white flex items-center justify-center font-bold animate-pulse-soft">3</span>
        </button>

        <!-- Profile Menu -->
        <div class="relative">
          <button
            id="profileMenuBtn"
            class="flex items-center gap-2 lg:gap-3 p-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 hover-lift"
          >
            <img src="https://i.pravatar.cc/40" alt="User" class="w-8 h-8 rounded-lg object-cover shadow-lg" />
            <i class="fas fa-chevron-down text-slate-400 text-sm hidden lg:block"></i>
          </button>
          
          <div
            id="profileDropdown"
            class="hidden absolute right-0 top-full mt-2 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden animate-slide-down z-[100]"
          >
            <!-- User Info -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
              <div class="flex items-center gap-3 mb-3">
                <img src="https://i.pravatar.cc/40" alt="User" class="w-12 h-12 rounded-xl object-cover shadow-md" />
                <div>
                  <div class="font-semibold text-slate-800 dark:text-slate-200">John Doe</div>
                  <div class="text-sm text-slate-500 dark:text-slate-400">john@company.com</div>
                </div>
              </div>
              <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                <div class="flex items-center gap-2">
                  <i class="fas fa-clock"></i>
                  <span id="currentTime"></span>
                </div>
                <div class="flex items-center gap-2">
                  <div class="w-2 h-2 rounded-full bg-green-500"></div>
                  <span>Online</span>
                </div>
              </div>
            </div>
            
            <!-- Menu Items -->
            <div class="p-2">
              <a href="/profile" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-user text-slate-500"></i>
                <span class="text-slate-700 dark:text-slate-300">Profile Settings</span>
              </a>
              <a href="/preferences" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-cog text-slate-500"></i>
                <span class="text-slate-700 dark:text-slate-300">Preferences</span>
              </a>
              <a href="/billing" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-credit-card text-slate-500"></i>
                <span class="text-slate-700 dark:text-slate-300">Billing</span>
              </a>
              
              <!-- Theme Toggle -->
              <button
                id="darkModeToggle"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 w-full text-left group"
              >
                <div class="relative">
                  <i class="fas fa-sun text-amber-500 dark:hidden transition-all duration-500"></i>
                  <i class="fas fa-moon text-slate-400 hidden dark:inline transition-all duration-500"></i>
                </div>
                <span class="text-slate-700 dark:text-slate-300">
                  <span class="dark:hidden">Switch to Dark Mode</span>
                  <span class="hidden dark:inline">Switch to Light Mode</span>
                </span>
                <div class="ml-auto">
                  <div class="w-10 h-6 bg-slate-200 dark:bg-slate-600 rounded-full relative transition-colors">
                    <div class="w-5 h-5 bg-white dark:bg-slate-300 rounded-full absolute top-0.5 left-0.5 dark:left-4 transition-all duration-300 shadow-sm"></div>
                  </div>
                </div>
              </button>
              
              <!-- Help & Support -->
              <a href="/help" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-question-circle text-slate-500"></i>
                <span class="text-slate-700 dark:text-slate-300">Help & Support</span>
              </a>
              
              <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
              
              <a href="/logout" class="flex items-center gap-3 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-red-600 dark:text-red-400">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 p-4 lg:p-8">
      <!-- Breadcrumbs -->
      <nav class="text-sm mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
          <li><a href="#" class="text-blue-600 hover:underline">Home</a></li>
          <li><i class="fas fa-chevron-right text-xs"></i></li>
          <li><a href="#" class="text-blue-600 hover:underline">Dashboard</a></li>
          <li><i class="fas fa-chevron-right text-xs"></i></li>
          <li class="text-gray-900 dark:text-gray-100">Overview</li>
        </ol>
      </nav>

      <!-- Dashboard Content -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-8">
 
      </div>

     
    </main>
  </div>

  <!-- Command Palette -->
  <div id="commandPalette" class="fixed inset-0 z-[100] hidden backdrop-blur-heavy bg-black/20 dark:bg-black/40">
    <div class="flex items-start justify-center pt-20">
      <div class="w-full max-w-2xl mx-4 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden animate-slide-down border border-gray-200 dark:border-gray-700">
        <div class="p-6">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
              <i class="fas fa-terminal text-white text-sm"></i>
            </div>
            <span class="font-semibold text-slate-700 dark:text-slate-300">Command Palette</span>
            <kbd class="ml-auto px-2 py-1 text-xs bg-slate-200 dark:bg-slate-700 rounded">ESC</kbd>
          </div>
          <input 
            type="text" 
            placeholder="Type a command or search..." 
            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-900 dark:text-slate-100"
            id="commandInput"
          />
          <div class="mt-4 space-y-2" id="commandResults">
            <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer">
              <i class="fas fa-search text-slate-400"></i>
              <span>Search projects...</span>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer">
              <i class="fas fa-plus text-slate-400"></i>
              <span>Create new project</span>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer">
              <i class="fas fa-cog text-slate-400"></i>
              <span>Open settings</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Advanced Theme Management
    class ThemeManager {
      constructor() {
        this.theme = localStorage.getItem('theme') || 'system';
        this.systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        this.init();
      }

      init() {
        this.applyTheme();
        this.setupEventListeners();
        this.updateTime();
        setInterval(() => this.updateTime(), 1000);
      }

      applyTheme() {
        const isDark = this.theme === 'dark' || (this.theme === 'system' && this.systemTheme === 'dark');
        document.documentElement.classList.toggle('dark', isDark);
        
        // Smooth transition effect
        document.body.style.transition = 'all 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
        setTimeout(() => {
          document.body.style.transition = '';
        }, 700);
      }

      toggle() {
        const themes = ['light', 'dark', 'system'];
        const currentIndex = themes.indexOf(this.theme);
        this.theme = themes[(currentIndex + 1) % themes.length];
        localStorage.setItem('theme', this.theme);
        this.applyTheme();
      }

      setupEventListeners() {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
          this.systemTheme = e.matches ? 'dark' : 'light';
          if (this.theme === 'system') {
            this.applyTheme();
          }
        });
      }

      updateTime() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('en-US', {
          hour12: true,
          hour: 'numeric',
          minute: '2-digit'
        });
        const dateStr = now.toLocaleDateString('en-US', {
          weekday: 'short',
          month: 'short',
          day: 'numeric'
        });
        const timeElement = document.getElementById('currentTime');
        if (timeElement) {
          timeElement.textContent = `${dateStr}, ${timeStr}`;
        }
      }
    }

    const themeManager = new ThemeManager();

    // Mobile Menu Management
    class MobileMenuManager {
      constructor() {
        this.sidebar = document.getElementById('sidebar');
        this.overlay = document.getElementById('sidebarOverlay');
        this.menuBtn = document.getElementById('mobileMenuBtn');
        this.init();
      }

      init() {
        this.menuBtn?.addEventListener('click', () => this.toggleSidebar());
        this.overlay?.addEventListener('click', () => this.closeSidebar());
        
        // Close sidebar when clicking on navigation links on mobile
        this.sidebar?.addEventListener('click', (e) => {
          if (e.target.tagName === 'A' && window.innerWidth < 1024) {
            this.closeSidebar();
          }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
          if (window.innerWidth >= 1024) {
            this.closeSidebar();
          }
        });
      }

      toggleSidebar() {
        const isOpen = !this.sidebar?.classList.contains('-translate-x-full');
        if (isOpen) {
          this.closeSidebar();
        } else {
          this.openSidebar();
        }
      }

      openSidebar() {
        this.sidebar?.classList.remove('-translate-x-full');
        this.overlay?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      closeSidebar() {
        this.sidebar?.classList.add('-translate-x-full');
        this.overlay?.classList.add('hidden');
        document.body.style.overflow = '';
      }
    }

    const mobileMenuManager = new MobileMenuManager();

    // Enhanced Dropdown Management
    class DropdownManager {
      constructor() {
        this.activeDropdown = null;
        this.init();
      }

      init() {
        this.setupProfileDropdown();
        this.setupCommandPalette();
        this.setupKeyboardShortcuts();
        this.setupClickOutside();
      }

      setupProfileDropdown() {
        const btn = document.getElementById('profileMenuBtn');
        const dropdown = document.getElementById('profileDropdown');
        
        btn?.addEventListener('click', (e) => {
          e.stopPropagation();
          this.toggleDropdown(dropdown, btn);
        });
      }

      setupCommandPalette() {
        const palette = document.getElementById('commandPalette');
        const commandInput = document.getElementById('commandInput');

        palette?.addEventListener('click', (e) => {
          if (e.target === palette) {
            palette.classList.add('hidden');
          }
        });
      }

      setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
          // Command Palette (Cmd/Ctrl + K)
          if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            const palette = document.getElementById('commandPalette');
            palette?.classList.remove('hidden');
            document.getElementById('commandInput')?.focus();
          }

          // Close Command Palette (Escape)
          if (e.key === 'Escape') {
            const palette = document.getElementById('commandPalette');
            if (!palette?.classList.contains('hidden')) {
              palette.classList.add('hidden');
            }
          }

          // Theme Toggle (Cmd/Ctrl + Shift + T)
          if ((e.metaKey || e.ctrlKey) && e.shiftKey && e.key === 'T') {
            e.preventDefault();
            themeManager.toggle();
          }
        });
      }

      toggleDropdown(dropdown, button) {
        if (this.activeDropdown && this.activeDropdown !== dropdown) {
          this.hideDropdown(this.activeDropdown);
        }

        const isHidden = dropdown?.classList.contains('hidden');
        
        if (isHidden) {
          dropdown?.classList.remove('hidden');
          button?.setAttribute('aria-expanded', 'true');
          this.activeDropdown = dropdown;
        } else {
          this.hideDropdown(dropdown);
        }
      }

      hideDropdown(dropdown) {
        dropdown?.classList.add('hidden');
        const button = dropdown?.previousElementSibling || 
                      document.querySelector(`[aria-controls="${dropdown?.id}"]`);
        button?.setAttribute('aria-expanded', 'false');
        if (this.activeDropdown === dropdown) {
          this.activeDropdown = null;
        }
      }

      setupClickOutside() {
        document.addEventListener('click', (e) => {
          if (this.activeDropdown && !this.activeDropdown.contains(e.target)) {
            const button = document.querySelector(`[aria-controls="${this.activeDropdown.id}"]`);
            if (!button?.contains(e.target)) {
              this.hideDropdown(this.activeDropdown);
            }
          }
        });
      }
    }

    const dropdownManager = new DropdownManager();

    // Enhanced Menu Toggle
    function toggleMenu(event, submenuId) {
      event.preventDefault();
      const submenu = document.getElementById(submenuId);
      const allSubmenus = document.querySelectorAll('nav [id^="submenu-"]');
      const button = event.currentTarget;
      const chevron = button.querySelector('.fa-chevron-down');
      
      const isOpen = !submenu?.classList.contains('hidden');

      // Close all other submenus
      allSubmenus.forEach(s => {
        if (s !== submenu) {
          s.classList.add('hidden');
          const btn = document.querySelector(`[aria-controls="${s.id}"]`);
          btn?.setAttribute('aria-expanded', 'false');
          btn?.querySelector('.fa-chevron-down')?.classList.remove('rotate-180');
        }
      });

      // Toggle current submenu
      if (!isOpen) {
        submenu?.classList.remove('hidden');
        button.setAttribute('aria-expanded', 'true');
        chevron?.classList.add('rotate-180');
      } else {
        submenu?.classList.add('hidden');
        button.setAttribute('aria-expanded', 'false');
        chevron?.classList.remove('rotate-180');
      }
    }

    // Theme toggle event
    document.getElementById('darkModeToggle')?.addEventListener('click', () => {
      themeManager.toggle();
    });

    // Enhanced animations on load
    document.addEventListener('DOMContentLoaded', () => {
      // Stagger animation for sidebar items
      const sidebarItems = document.querySelectorAll('nav ul li');
      sidebarItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        setTimeout(() => {
          item.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
          item.style.opacity = '1';
          item.style.transform = 'translateX(0)';
        }, index * 100);
      });

      // Header animation
      const header = document.querySelector('header');
      if (header) {
        header.style.opacity = '0';
        header.style.transform = 'translateY(-20px)';
        setTimeout(() => {
          header.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
          header.style.opacity = '1';
          header.style.transform = 'translateY(0)';
        }, 200);
      }

      // Main content animation
      const main = document.querySelector('main');
      if (main) {
        main.style.opacity = '0';
        main.style.transform = 'translateY(20px)';
        setTimeout(() => {
          main.style.transition = 'all 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
          main.style.opacity = '1';
          main.style.transform = 'translateY(0)';
        }, 400);
      }

      // Cards animation
      const cards = document.querySelectorAll('.hover-lift');
      cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        setTimeout(() => {
          card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
          card.style.opacity = '1';
          card.style.transform = 'translateY(0)';
        }, 600 + (index * 150));
      });
    });

    // Intersection Observer for scroll animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fade-in');
        }
      });
    }, observerOptions);

    // Observe elements for scroll animations
    document.querySelectorAll('.hover-lift').forEach(el => {
      observer.observe(el);
    });

    // Touch gesture support for mobile sidebar
    if ('ontouchstart' in window) {
      let startX = 0;
      let currentX = 0;
      let isDragging = false;

      document.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = startX < 20; // Only start drag if touch starts from edge
      });

      document.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
        const diff = currentX - startX;
        
        if (diff > 50 && window.innerWidth < 1024) {
          mobileMenuManager.openSidebar();
          isDragging = false;
        }
      });

      document.addEventListener('touchend', () => {
        isDragging = false;
      });
    }
  </script>
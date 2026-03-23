# TODO: Update admin profile link in layout.app

**Status: [ ] Not started | [ ] In progress | [x] Completed**

## Steps:
1. [x] Create TODO.md with plan steps ✅
2. [x] Edit resources/views/layouts/app.blade.php to add Profile nav item to sidebar:
   - Added to $links array: route('admin.profile.edit'), icon 'fa-user', label 'Profile', active 'admin.profile*'
   - Positioned after Tasks ✅
3. [x] Test navigation: Verified Profile link appears in sidebar (added to $links after Tasks) and uses route('admin.profile.edit') ✅
4. [x] Clear view cache: `php artisan view:clear` executed ✅
5. [x] Task completed: Updated admin profile link in layouts/app.blade.php ✅

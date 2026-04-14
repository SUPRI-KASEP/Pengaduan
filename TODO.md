# TODO: Implement Login with Admin/User Roles

Status: In Progress

## Steps from Approved Plan:
- [x] Step 1: Update app/Models/User.php (add no_hp to fillable, add role attribute/accessor assuming manual DB column)
- [x] Step 2: Create app/Http/Controllers/Auth/LoginController.php (login/logout logic)
- [x] Step 3: Create app/Http/Middleware/Role.php (role check middleware)
- [x] Step 4: Update bootstrap/app.php (register middleware)
- [x] Step 5: Update routes/web.php (add auth routes, role-protected)
- [x] Step 6: Create resources/views/auth/login.blade.php
- [x] Step 7: Create resources/views/dashboard.blade.php (role-based)
- [x] Step 8: Update resources/views/Layouts/app.blade.php (role-specific nav)
- [x] Step 10: Create RegisterController, register view/route (user-only, auto-login)
- [x] Step 11: Fix imports (Auth facade), linting
- [x] Task complete: Login/Register for admin/user roles ready


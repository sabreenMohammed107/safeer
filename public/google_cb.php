<?php
use Illuminate\Contracts\Http\Kernel;
use Laravel\Socialite\Facades\Socialite;

define('LARAVEL_START', microtime(true));

// 1. تحميل عصب لاراول
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

try {
    // 2. جلب بيانات المستخدم من جوجل مباشرة بدون اعتراض الـ IIS
    $googleUser = Socialite::driver('google')->stateless()->user();

    // 3. البحث عن المستخدم أو إنشاؤه في قاعدة البيانات
    $user = App\Models\SiteUser::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = App\Models\SiteUser::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt(str_random(16)),
        ]);
    } else {
        $user->google_id = $googleUser->getId();
        $user->save();
    }

    // 4. تسجيل دخول المستخدم في النظام والتحويل للرئيسية
    Auth::login($user);
    header('Location: /home'); // أو المسار الرئيسي لديك
    exit;

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
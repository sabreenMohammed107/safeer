# safer.travel — Project Architecture Reference

> **Purpose:** This file is the canonical reference for the safer.travel codebase. It is meant to be read by Claude (and any dev) at the start of future sessions so the project's structure, routes, and known issues don't need to be re-explained. Keep it updated as the project evolves — treat drift here as a bug.
>
> Last verified against the codebase: 2026-09-14 (branch `main`, commit `28ecc47`).

---

## 1. Project Overview & Tech Stack

**safer.travel** is a bilingual (English/Arabic) travel-booking platform: hotels, tours, transfers, visas, offers/deals, blog, and an admin dashboard to manage all of it.

| Layer | Technology |
|---|---|
| Framework | Laravel **9.19** (PHP `^8.4.1`) |
| Frontend build | Vite 3 + `laravel-vite-plugin` (compiles `resources/sass/app.scss` + `resources/js/app.js`) |
| Legacy/static frontend assets | Plain CSS/JS under `public/website_assets/` and `public/src/`, **not** built through Vite |
| Admin dashboard UI | Prebuilt Metronic-style theme in `public/dist/` (Bootstrap-based) |
| Database | MySQL (`config/database.php`, driver `mysql`) via Eloquent ORM |
| Dynamic components | Livewire 2.12 (`ExploreSection`, `Offers`) |
| Auth (admin/dashboard) | Laravel's built-in session guard (`config/auth.php`, guard `web`, provider `users` → `App\Models\User`), role gated via `type` column and `user-access:{admin|manager|user}` middleware |
| Auth (public site) | **Custom, parallel** session-based auth — not Laravel's `Auth` facade. Login/register/logout handled by `App\Http\Controllers\SiteAuth\AuthController`, session key `SiteUser`, model `App\Models\SiteUser`, guarded by `is-site-auth` / `prevent-relogin` middleware |
| Social login | `laravel/socialite` — Google (`SiteAuth\GoogleController`) and Facebook (`SiteAuth\FaceBookController`) |
| Localization | `mcamara/laravel-localization` — locale prefix routing, `en`/`ar` supported, translations in `resources/lang/{en,ar}/*.php` |
| Mail | SMTP (`MAIL_MAILER=smtp` in `.env`) — no Mailgun/Postmark/SES actually configured (those are Laravel defaults left unused); Blade mail views in `resources/views/emails/` (`order`, `newsLetter`, `password_reset`) |
| Captcha | `mews/captcha` (used on contact/register forms) |
| QR codes | `simplesoftwareio/simple-qrcode` |
| Third-party data services | **No Airtable integration found in the codebase.** All data is local MySQL via Eloquent — do not assume Airtable is wired in unless it's added later. |
| File storage | Local disk — uploaded images live under `public/uploads/{blogs,carModels,company,counter,explore,features,galleries,hotels,offers,orders,tours,uploads,whyUs}` |

---

## 2. Directory Structure & Key Files

### Controllers — `app/Http/Controllers/`
Flat, resource-per-entity controllers for the **admin CRUD** side (e.g. `HotelController.php`, `TourController.php`, `OfferController.php`, `BlogController.php`, `VisaController.php`, `TransferController.php`, `CompanyController.php`, `UsersOrderController.php`, `UsersRoleController.php`, etc.) — one per Eloquent model, wired as `Route::resource()` under `/dashboard`.

Public-facing (website) logic is split out into `app/Http/Controllers/Website/`:
- `MainController.php` — homepage (`/`), terms, dynamic city search
- `ContentController.php` — about, blogs, offers, contact, careers, partners, login/register views, captcha
- `HotelsController.php` — hotel listing/search/profile/favourites
- `HotelsControllerquery.php`, `oldHotelController.php` — **legacy/duplicate**, not routed (see §4 Known Issues)
- `ToursController.php` — tour listing/profile/booking/favourites
- `SiteTransferController.php` — transfer search/booking
- `VisaDataController.php` — visa listing/booking
- `BookingController.php` — cart, order placement, order success

Site auth: `app/Http/Controllers/SiteAuth/` — `AuthController.php` (login/register/logout/reset-password/profile), `GoogleController.php`, `FacebookController.php`, `Services/RememberMeServices.php`.

Standard Laravel scaffolding auth (admin side, mostly unused/legacy given the custom SiteAuth system): `app/Http/Controllers/Auth/`.

### Models — `app/Models/`
One model per DB table, `Snake_Case` naming mixed with Laravel conventions (inconsistent — e.g. `Best_hotel`, `Car_class`, `Hotel_type` alongside `Hotel`, `Offer`, `Company`). Notable ones:
- `SiteUser.php` — public website users (separate from `User.php`, which is the admin/staff user model)
- `Orders.php`, `OrderDetails.php`, `OrderPersons.php`, `RoomDetails.php`, `TourDetails.php`, `TransferDetails.php`, `VisaDetails.php` — booking/order domain
- `Favorite_hotels_tour.php` — "add to favourite" join table (hotel/tour ↔ user)
- `Newsletter.php` **and** `News_letter.php` — likely duplicate/legacy (verify which is live before touching)
- `Company.php` — single-row site settings (contact info, `chat_whatsapp` number, social links) fetched via `Company::first()` throughout views

### Views / Blade — `resources/views/`
- `website/` — all public-facing pages (home, hotels, tours, transfer, visa, offers, blogs, contact, careers, cart, booking, login/signup, agents, about, partners, terms)
- `website/hotels/`, `website/tours/`, `website/offers/`, `website/blogs/`, `website/transfer/`, `website/visa/`, `website/sections/` — sub-pages/partials per domain
- `admin/` — dashboard CRUD views, one subfolder per entity (`hotels/`, `tours/`, `offers/`, `blogs/`, `visa/`, `transfer/`, `users-orders/`, `user-role/`, `company/`, etc.), each typically has `index`/`add`/`edit`/`show`
- `layout/` — main site chrome: `main.blade.php`, `header.blade.php`, `footer.blade.php`, `aside.blade.php` (admin sidebar), `style.blade.php`, `footerscripts.blade.php`
- `layout/website/layout.blade.php` — **the** public-site master layout (head, WhatsApp widget script, footer scripts)
- `components/website/` — Blade components: `header.blade.php` (+ `header/general.blade.php`, `header/home.blade.php`), `home/counters.blade.php`, `home/offers.blade.php`, `hotels/search_cards.blade.php`, `hotels/search_hotel_cards.blade.php`
- `livewire/` — `explore-section.blade.php`, `offers.blade.php` (paired with `app/Http/Livewire/ExploreSection.php`, `Offers.php`)
- `emails/` — transactional email templates
- `auth/` — mix of current (`password_reset.blade.php`, `reset.blade.php`) and legacy (`loginOld.blade.php`, `log2.blade.php`) files

### Asset Management
Two **separate, non-integrated** asset pipelines:
1. **Vite-built** (`resources/css`, `resources/js`, `resources/sass` → `public/build/assets`) — minimal, mostly scaffold-default; check `vite.config.js` before assuming this is what's actually rendering a given page.
2. **Static/legacy assets served directly**, no build step:
   - `public/website_assets/` — public website CSS/JS/images/fonts (`css/style.css`, `css/style-ar.css` for RTL Arabic, `css/whatsappStyle.css`, `js/`, `slick/` carousel, `webfonts/`). Also has parallel `css-old/` and `jsOld/` directories — legacy leftovers.
   - `public/dist/` — admin dashboard theme (Metronic-derived): `assets/`, `pages/`, `layouts/`, `authentication/`, `account/`, `apps/`, `dashboards/`, `documentation/`, `utilities/`.
   - `public/src/` — additional source JS/SCSS/media referenced directly (not compiled by Vite).
3. **Uploads** — `public/uploads/{entity}/` — user/admin-uploaded images per module, served directly from disk.

### Routes — `routes/`
- `web.php` — all site + admin routes (see §3 below; this is the file you'll touch most)
- `api.php`, `channels.php`, `console.php` — present but not central to current feature work

### Middleware — `app/Http/Middleware/`
- `UserAccess.php` — checks `auth()->user()->type` against a route-parameter role (`admin`/`manager`/`user`); registered as alias `user-access`
- `IsSiteAuthenticated.php` (`is-site-auth`) — gates public-site pages that require a logged-in `SiteUser`
- `PreventMultiAuth.php` (`prevent-relogin`) — blocks visiting login/register while already logged in
- Standard Laravel middleware otherwise unmodified

---

## 3. Routes & Core Pages Map

All public routes are wrapped in a locale-prefixed group (`LaravelLocalization::setLocale()`), so every path below can be reached at `/` (default `en`) or `/ar/...`.

| Page / Feature | Route | Controller@method |
|---|---|---|
| Homepage | `GET /` | `MainController@index` |
| Hotels listing | `GET /hotels`, `POST /hotels` | `HotelsController@all_hotels` / `hotels` |
| Single hotel | `GET /hotels/{id}` | `HotelsController@profile` |
| Add/remove favourite hotel | `GET /favourite/{id}`, `GET /removeFavourite/{id}` | `HotelsController@favourite` / `removeFavourite` |
| Tours listing | `GET /tours`, `POST /tours` | `ToursController@all_tours` / `tours` |
| Single tour | `GET /tours/{id}/{slug?}` | `ToursController@profile` |
| Add/remove favourite tour | `GET /favouriteTours/{id}`, `GET /removeFavouriteTours/{id}` | `ToursController@favourite` / `removeFavourite` |
| Transfers | `GET/POST /transfers` | `SiteTransferController@all_transfer` / `transfer` |
| Visa | `GET /visa`, `POST /Safer/BookVisa` | `VisaDataController@all_visa` / `bookVisas` |
| Offers listing | `GET /offers` | `ContentController@offers` |
| Single offer | `GET /single-offer/{id}/{slug?}` | `ContentController@singleOffer` (route name `single-offer`) |
| Blog listing | `GET /blogs` | `ContentController@blogs` |
| Single blog | `GET /single-blog/{id}/{slug?}` | `ContentController@singleBlog` (route name `single-blog`) |
| About | `GET /about` | `ContentController@about` |
| Contact (form + submit) | `GET/POST /contact` | `ContentController@createForm` / `ContactUsForm` (route name `contact.store`) |
| Newsletter signup | `POST /sendNewsLetter` | `ContentController@sendNewsLetter` |
| Careers | `GET /careers` | `ContentController@careers` (route name `careers`) |
| Applicant form | `GET /applicant` | closure in `web.php` → `website.applicantForm` view |
| Partners | `GET /partners` | `ContentController@partners` (route name `partners`) |
| Agents page | commented out in `web.php` (`website.Agents` view exists but route is currently disabled) | — |
| Site login | `GET /safer/login`, `POST /safer/login` | `ContentController@loginSite` / `AuthController@Login` (names `siteLogin`, `ProceedLogin`) |
| Site register | `GET /safer/register`, `POST /safer/register` | `ContentController@signupSite` / `AuthController@Register` |
| Site logout | `GET /safer/logout` | `AuthController@Logout` (name `siteLogout`) |
| Password reset request | `GET /password/reset`, `POST /password/email` | closure → `auth.password_reset` view / `AuthController@sendResetLink` |
| Password reset form | `GET /password/reset/{token}` | closure → `auth.reset` view |
| Password reset submit | `POST /password/reset`, `POST /password/update` | `AuthController@resetPassword` / `updatePassword` |
| Google login | `GET /auth/login`, `GET/ANY /auth/google/callback` | `GoogleController@loginWithGoogle` / `callbackFromGoogle` |
| Facebook login | `GET /facebook/auth`, `GET /facebook/callback` | `FaceBookController@loginUsingFacebook` / `callbackFromFacebook` |
| User profile (site) | `GET /safer/profile/{id}` (auth: `is-site-auth`) | `AuthController@profile` (name `siteProfile`) |
| Update profile | `POST /safer/updateProfile` | `AuthController@updateProfile` |
| Cart | `GET /cart` (auth: `is-site-auth`) | `BookingController@Cart` (name `get_cart`) |
| Place order | `POST /Book` (auth: `is-site-auth`) | `BookingController@MakeOrder` |
| Order confirmation | `GET /Safer/OrderPlacement/{id}` (auth: `is-site-auth`) | `BookingController@SuccessOrder` (name `successOrder`) → `website.bookingSuccess` view |
| Room booking | `GET /safer/room/{id}/book/{cap}` | `BookingController@BookRoom` (name `bookRoom`) |
| Terms | `GET /terms` | `MainController@terms` |
| Sitemap | `GET /sitemap.xml` | closure serving `public/sitemap.xml` |
| Cache clear (dev utility) | `GET /clear-cache` | closure running `artisan cache:clear` + `route:clear` — **no auth guard, should be removed/protected before going to production if not already** |

### Admin dashboard (`/dashboard`, middleware `auth` + `user-access:admin`)
All standard `Route::resource()` CRUD for: `cities`, `room-types`, `tours`, `hotels`, `features`, `hotelTag`, `tourTag`, `galleries`, `tour-galleries`, `blog-categories`, `blogs`, `why-us`, `explore`, `best-hotel`, `hotel-price`, `counter`, `company`, `branch`, `offers`, `site-users`, `users-orders`, `fav-hotels`, `car-models`, `car-navigate`, `transfer-location`, `transfer`, `countries`, `site-countries`, `nationalities`, `visaType`, `visa`, `user-role`, `featureCategories`.

Plus non-resource admin endpoints: order-editing AJAX actions (`EditTourDetails`, `EditholderDetails`, `EditTourPersons`, `deleteTourPersons`, `AddAdultTourPersons`, `AddChildTourPersons`, `updateStatus`, `EditTransDetails`, `EditVisaDetails`, `receiptSave`, `storeAssign`/`assignThisOrder`), newsletter subscriber list (`/newsletterEmails`), contact submissions (`/contact` inside dashboard prefix — **note this name collides conceptually with the public `/contact` route but is a different path since it's under `/dashboard`**).

### Manager area
`GET /manager/home` (middleware `auth` + `user-access:manager`) → `HomeController@managerHome`.

---

## 4. Current Features & Known Issues

### Working features
- **Favourites**: hotels and tours can be favourited/unfavourited (`Favorite_hotels_tour` model). Implementation is **server-side redirect-based, not AJAX** (`HotelsController@favourite` returns `redirect()->back()`). If not logged in, the target id is stashed in session (`AddFavHotel` / `RemFavHotel`) and the user is redirected to `/safer/login` — presumably resumed post-login, verify this resume logic still exists in `AuthController@Login` before relying on it.
- **WhatsApp widget**: custom-built floating chat widget (not a third-party embed despite Elfsight-style class names in the markup), implemented in `resources/views/components/website/header.blade.php` (markup) + `resources/views/layout/website/layout.blade.php` (behavior script + `whatsappStyle.css`). Phone number pulled from `$Company->chat_whatsapp` (single-row `Company` model/settings).
- **Newsletter**: subscribe form posts to `/sendNewsLetter`; admin can view subscribers at `/dashboard/newsletterEmails`; confirmation email template at `resources/views/emails/newsLetter.blade.php`.
- **Bilingual EN/AR**: full locale-prefixed routing via `mcamara/laravel-localization`; separate RTL stylesheet `css/style-ar.css` for Arabic.
- **Social login**: Google + Facebook via Socialite, alongside native email/password site registration.
- **Order emails**: `resources/views/emails/order.blade.php` sent on booking (hotels/tours/transfers/visa go through a shared `Orders`/`OrderDetails` domain).

### Known issues / technical debt to be aware of
1. **Duplicate/legacy files not wired into current routes** — safe to ignore unless asked to clean up, but don't confuse them with the live version:
   - `Website/oldHotelController.php`, `Website/HotelsControllerquery.php`
   - `website/hotels/hotelsOld.blade.php`, `hotel_profileOld.blade.php`
   - `admin/hotels/editOld.blade.php`, `admin/galleries/index-old.blade.php`
   - `auth/loginOld.blade.php`, `auth/log2.blade.php`
   - `components/website/header/oldHome.blade.php`
   - CSS/JS: `public/website_assets/css-old/`, `cssOld/`, `jsOld/`
   - Possible duplicate models: `Newsletter.php` vs `News_letter.php` — confirm which is actually referenced before editing either.
2. **Two parallel auth systems** — Laravel's native `Auth` (admin/dashboard, `User` model, `web` guard) and a **hand-rolled session-based auth** for the public site (`SiteUser` model, `session('SiteUser')`, custom middleware). Easy to mix these up — always check which controller/middleware a page uses before assuming `auth()->user()` works (it won't for site visitors).
3. **Image paths**: uploads are stored per-module under `public/uploads/{module}/` and referenced directly (no Laravel Storage facade/symlink pattern observed in routes reviewed) — broken images typically trace back to a mismatched relative path or a missing file in the corresponding `uploads/` subfolder rather than a code bug. Check the exact `asset('uploads/...')` path construction in the relevant Blade/controller when debugging.
4. **Two disconnected asset pipelines** (Vite-built vs. static `website_assets`/`dist`) — a CSS/JS change may need to go in the static folder, not `resources/`, depending on which page it affects. Always check which pipeline a given page's `<link>`/`<script>` tags pull from before editing.
5. **`/clear-cache` route is unauthenticated** and defined twice in `web.php` (lines ~71 and ~386) — flag if asked about security hardening or route cleanup.
6. **Agents page route is commented out** in `web.php` even though `website/Agents.blade.php` exists — confirm with the user whether this is intentionally disabled before re-enabling or assuming it's live.
7. **Performance**: no evidence of route/view caching config beyond defaults; large uploaded-image directories served directly from `public/uploads` with no observed image optimization/CDN step — worth confirming before treating any "slow page" report as a code-level bug.

---

## 5. Conventions to Follow

- New public-facing routes go inside the `LaravelLocalization::setLocale()` group in `routes/web.php` so they get locale prefixing.
- New admin CRUD entities follow the existing pattern: model in `app/Models/`, controller in `app/Http/Controllers/`, `Route::resource()` under the `/dashboard` group, views in `resources/views/admin/{entity}/`.
- Site-auth-gated public routes use `is-site-auth` middleware, **not** `auth`.
- Admin-only routes use `auth` + `user-access:admin`.
- Check `Company::first()` for any site-wide settings (contact info, WhatsApp number, social links) rather than hardcoding.

---

*This document was generated by inspecting the actual repository (routes, controllers, models, views, config) rather than assumed from generic Laravel/travel-site conventions. If something here looks stale, re-verify against the code before trusting it — especially §4, which will drift fastest.*

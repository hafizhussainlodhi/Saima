<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$city = \App\Models\City::find(2) ?: \App\Models\City::first();
if (!$city) {
    echo "No city found.\n";
    exit(1);
}

echo "Testing City ID {$city->id} ({$city->name})\n";

// Simulate PUT request with active_tab = 'content'
$request = Illuminate\Http\Request::create(
    "/admin/cities/{$city->id}",
    'PUT',
    [
        'name' => $city->name,
        'slug' => $city->slug,
        'active_tab' => 'content',
        'sections' => [
            'content' => [
                'html' => '<p>Test content verification</p>',
            ],
        ],
    ]
);
$app->instance('request', $request);

// Authenticate as first user/admin
$user = \App\Models\User::first();
\Illuminate\Support\Facades\Auth::login($user);

$controller = $app->make(\App\Http\Controllers\Admin\CityController::class);
$response = $controller->update($request, $city);

echo "Status Code: " . $response->getStatusCode() . "\n";
$targetUrl = $response->headers->get('Location');
echo "Redirect Location: " . $targetUrl . "\n";

if (str_contains($targetUrl, "/admin/cities/{$city->id}/edit") && str_contains($targetUrl, "tab=content")) {
    echo "SUCCESS: City update redirected to edit screen with active tab!\n";
} else {
    echo "FAILED: Did not redirect to edit screen with tab=content.\n";
}

// Also test GET request to edit page with tab=content
$getRequest = Illuminate\Http\Request::create("/admin/cities/{$city->id}/edit?tab=content", 'GET');
$getResponse = $kernel->handle($getRequest);
$html = $getResponse->getContent();

if (str_contains($html, 'id="edit_tab_content" class="tab-pane active"')) {
    echo "SUCCESS: edit_tab_content is marked active on render!\n";
} else {
    echo "CHECK: edit_tab_content active state in HTML\n";
}

// Test Community
$community = \App\Models\Community::first();
if ($community) {
    echo "\nTesting Community ID {$community->id} ({$community->name})\n";
    $commReq = Illuminate\Http\Request::create(
        "/admin/communities/{$community->id}",
        'PUT',
        [
            'name' => $community->name,
            'slug' => $community->slug,
            'city_id' => $community->city_id,
            'active_tab' => 'faq',
        ]
    );
    $app->instance('request', $commReq);
    $commController = $app->make(\App\Http\Controllers\Admin\CommunityController::class);
    $commRes = $commController->update($commReq, $community);
    $commTargetUrl = $commRes->headers->get('Location');
    echo "Community Redirect Location: " . $commTargetUrl . "\n";
    if (str_contains($commTargetUrl, "/admin/communities/{$community->id}/edit") && str_contains($commTargetUrl, "tab=faq")) {
        echo "SUCCESS: Community update redirected to edit screen with tab=faq!\n";
    } else {
        echo "FAILED: Community update did not redirect with tab=faq\n";
    }
}

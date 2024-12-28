<?php

function renderAstroPage(): void
{
  Flight::route('*', function () {
    $htmlPath = mb_substr(Flight::request()->url, 1, mb_strlen(Flight::request()->url));

    if (Flight::view()->exists($htmlPath)) {
      $html = Flight::view()->fetch($htmlPath);
    } elseif (!$htmlPath && Flight::view()->exists('index')) {
      $html = Flight::view()->fetch('index');
    } else {
      return true;
    }

    $assetsFixedPaths = [
      '/_astro' => '/' . Flight::view()->path . '/_astro'
    ];

    $globPattern = ROOT . '/' . Flight::view()->path . '/*';

    foreach (glob($globPattern) as $publicAsset) {
      [$assetPath] = array_reverse(explode('/', $publicAsset));

      $assetsFixedPaths["./$assetPath"] = Flight::view()->path . "/$assetPath";
    }

    $html = str_replace(
      array_keys($assetsFixedPaths),
      array_values($assetsFixedPaths),
      $html
    );

    echo $html;
  });
}

Flight::route('POST /login', function (): void {
  // TODO: verify credentials

  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  $_SESSION['auth.user.id'] = uniqid('USER_');
  $_SESSION['auth.user.email'] = Flight::request()->data->email;
  Flight::redirect('/');
});

Flight::route('/logout', function (): void {
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  unset($_SESSION['auth.user.id']);
  unset($_SESSION['auth.user.email']);
  Flight::redirect(Flight::request()->referrer);
});

// Customize routes whatever you like 💡
renderAstroPage();

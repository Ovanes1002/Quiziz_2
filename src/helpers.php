<?php

session_start();

require_once __DIR__ . '/config.php';

function redirect(string $path) 
{
    header( header: "Location: $path" );
    die();
}

// присваивание полю ошибки
function setValidationError (string $fieldName, string $message) 
{
    $_SESSION['validation'][$fieldName] = $message;
}


// возвращает true, если поле $fieldName пустое, иначе false
function hasValidationError (string $fieldName): bool 
{
    return isset($_SESSION['validation'][$fieldName]);
}

// добавляет инпуту атрибут aria-invalid="true" если поле $fieldName пустое
function validationErrorAttr(string $fieldName) 
{
    echo isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

// возвращает текст ошибки для поля $fieldName или пустую строку, если ошибки нет
function validationErrorMessage(string $fieldName) 
{
    $message = $_SESSION['validation'][$fieldName] ?? ''; // Если элемент с индексом $fieldName не определен в массиве $_SESSION['validation'], то оператор ?? вернет пустую строку вместо возникновения ошибки
    unset($_SESSION['validation'][$fieldName]); // удаляем из массива $_SESSION['validation'] элемент с индексом $fieldName
    echo $message; 
}

function setOldValue (string $key, mixed $value) 
{
    $_SESSION['old'][$key] = $value;
}

function getOldValue (string $key) 
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function uploadFile (array $file, string $prefix = ''):string 
{

    $uploadPath = __DIR__ . '/uploads';

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, permissions: 0777, recursive: true);
    }

    $avatarExtension = pathinfo($file['name'], flags: PATHINFO_EXTENSION);
    $fileName = $prefix . time() . ".$avatarExtension";

    if(!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
        die('Ошибка загрузки файла на сервер');
    }

    return "uploads/$fileName";
}

function setMessage (string $key, string $message): void 
{
    $_SESSION['message'][$key] = $message; 
}

function hasMessage (string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

function getMessage (string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function getPDO (): PDO 
{
    try {
        return new \PDO(dsn: 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8;dbname=' . DB_NAME, username: DB_USERNAME, password: DB_PASSWORD);
    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }

}

function findUser(string $email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare(query:"SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function currentUser(): array|bool
{
    $pdo = getPDO();

    if(!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare(query:"SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function logout (): void
{
    unset($_SESSION['user']['id']);
    redirect(path: '/');
}

function checkAuth(): void
{
    if(!isset($_SESSION['user']['id'])) {
        redirect(path: '/');
    }
}

function checkGuest(): void
{
    if(isset($_SESSION['user']['id'])) {
        redirect(path: '/profile.php');
    }
}

?>
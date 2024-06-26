<?php

require_once __DIR__ . '/../helpers.php';

$quizName = $_POST['quizName'] ?? null;
$trimmedName = trim(preg_replace('/\s+/', ' ', $quizName));

$quizIconPath = null;
$quizIcon = $_FILES['quizIcon'] ?? null;

$_SESSION['quiz_name'] = substr($trimmedName, 0, 30);
$_SESSION['quizIcon'] = $quizIcon;

if ($quizIcon !== null && $quizIcon['error'] === UPLOAD_ERR_OK) {

    $types = ['image/png', 'image/jpeg'];

    if (!in_array($quizIcon['type'], $types)) {
        setValidationError(fieldName: 'quizIcon', message: 'Обложка имеет неверный тип');
    }

    if (($quizIcon['size'] / 1000000) >= 2) {
        setValidationError(fieldName: 'quizIcon', message: 'Обложка должна быть весом не больше 2 МБ');
    }
}

if (!empty($_SESSION['validation'])) {
    redirect(path: '/quizTheme.php');
} 

if (!empty($quizIcon)) {
    $quizIconPath = uploadQuizIconFile(file: $quizIcon, prefix: 'quizIcon_');
}

insertQuizName($trimmedName, $quizIconPath);
$_SESSION['lastQuizId'] = lastQuizId();
$_SESSION['quiz_question_number'] = 1;
redirect(path: '/quizBuilder.php');

?>
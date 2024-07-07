<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;

class MyDashboardController extends Controller
{
    public function index()
    {
        // Example: Get total form submissions
        $totalSubmissions = FormEntry::count();

        // Example: Get submissions per day for the last 7 days
        $submissionsPerDay = FormEntry::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('dashboard', compact('totalSubmissions', 'submissionsPerDay'));
    }

    public function success()
    {
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Success</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .container {
                    text-align: center;
                    background: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .success-message {
                    font-size: 24px;
                    color: #28a745;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1 class="success-message">Success!</h1>
                <p>Your operation was completed successfully.</p>
            </div>
        </body>
        </html>
        ';

        return response($html, 200)
            ->header('Content-Type', 'text/html');
    }

    public function fail()
    {
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Failure</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .container {
                    text-align: center;
                    background: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .error-message {
                    font-size: 24px;
                    color: #dc3545;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1 class="error-message">Failure!</h1>
                <p>Sorry, something went wrong.</p>
            </div>
        </body>
        </html>
        ';

        return response($html, 400)
            ->header('Content-Type', 'text/html');
    }

    public function wrongPublishableSecret()
    {
        $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Incorrect Publishable Secret Key</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                text-align: center;
                background: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .error-message {
                font-size: 24px;
                color: #dc3545;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1 class="error-message">Incorrect Publishable Secret Key!</h1>
            <p>The publishable secret key provided is invalid.</p>
        </div>
    </body>
    </html>
    ';

        return response($html, 400)
            ->header('Content-Type', 'text/html');
    }
}

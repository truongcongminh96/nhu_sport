<?php

namespace App\Strategy;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface BuildProfileStrategyInterface
{
    /**
     * @param Request $request
     * @return void
     */
    public function updateProfile(Request $request): void;
}

<?php

namespace App\Context;

use App\Strategy\BuildProfileStrategyInterface;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class BuildProfileContext
{
    private BuildProfileStrategyInterface $buildProfileStrategyInterface;

    /**
     * @param BuildProfileStrategyInterface $buildProfileStrategyInterface
     * @return void
     */
    public function setBuildProfileContext(BuildProfileStrategyInterface $buildProfileStrategyInterface): void
    {
        $this->buildProfileStrategyInterface = $buildProfileStrategyInterface;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function runUpdateProfile(Request $request): void
    {
        $this->buildProfileStrategyInterface->updateProfile($request);
    }
}

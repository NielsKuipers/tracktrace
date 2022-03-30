<?php

namespace App\Jobs;

use App\Models\Label;
use App\Models\Package;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Spatie\Image\Manipulations;

class ProcessBrowsershot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected string $url;
    protected string $image;
    protected string $token;
    protected string $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $url, int $id)
    {
        $this->url = $url . $id;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $image = Browsershot::url($this->url)
            ->noSandbox()->clip(750, 100, 500, 500)->windowSize(1920, 1080)
            ->timeout(360)->base64Screenshot();

        $this->addLabel($this->id, $image);
    }

    public function addLabel(int $id, string $image)
    {
        Label::create([
            'package_id' => $id,
            'label_image' => $image
        ]);
    }
}

<?php

namespace App\Jobs;

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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $url;
    protected string $image;
    protected string $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $this->image = Browsershot::url($this->url)->setExtraHttpHeaders(['Authorization' => 'Bearer 2|M9XBhHktk9rup8Xfe2BhhszIj4axSR7s8tzL4QKs'])->noSandbox()->clip(540, 10, 900, 500)->windowSize(1920, 1080)->timeout(360)->base64Screenshot();
        try {
            Browsershot::url($this->url)
                ->noSandbox()->clip(860, 100, 230, 468)->windowSize(1920, 1080)
                ->timeout(360)->save('mario.png');
        } catch (CouldNotTakeBrowsershot $e) {
            error_log($e);
        }
    }

    public function getResponse(): string
    {
        return $this->image;
    }
}

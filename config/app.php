<?php
return [
'providers' => ServiceProvider::defaultProviders()->merge([
        

        wpiservice\WpiService\IWpiServiceProvider::class,

    ])->toArray(),
    ];
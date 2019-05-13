<?php

if( ! function_exists('lz_url') ) {

    /**
     * @param string $url
     *
     * @return \Spatie\Url\Url|string
     */
    function lz_url(string $url = null) {
        return \Spatie\Url\Url::fromString( $url ?: request()->getUri() );
    }
}
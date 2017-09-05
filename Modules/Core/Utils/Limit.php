<?php
namespace Modules\Core\Utils;

interface Limit
{

    /**
     * DB Query limit for general purpose.
     */
    const NORMAL = 10;

    const SETTINGS = 10;
    /**
     * DB Query limit for search
     */
    const SEARCH_LIMIT = 20;

    /**
     * DB Query limit for autocomplete search
     */
    const SEARCH_AUTOCOMPLETE_LIMIT = 10;

    /**
     * DB Query limit for post comment
     */
    const COMMENT_LIMIT = 10;

    /**
     * DB Query limit for timeline data
     */
    const TIMELINE = 8;

    /**
     * DB Prefix for search
    */
    const QUERY = 'bp';
}
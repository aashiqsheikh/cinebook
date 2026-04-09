<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Date Formatting Helper Functions
 *
 * Provides reusable date and time formatting utilities
 * across the application for consistency and maintainability.
 */
class DateHelper
{
    /**
     * Format a date with a given format string
     *
     * @param mixed $date The date to format (string, DateTime, Carbon instance)
     * @param string $format The format string (default: 'D, d M Y')
     * @return string Formatted date string
     *
     * @example
     * formatDate($date) → 'Wed, 03 Apr 2026'
     * formatDate($date, 'M Y') → 'Apr 2026'
     * formatDate($date, 'Y-m-d') → '2026-04-03'
     */
    public static function formatDate($date, string $format = 'D, d M Y'): string
    {
        if (!$date) {
            return '';
        }

        try {
            return Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            \Log::warning('Date format failed for date: ' . $date, ['error' => $e->getMessage()]);
            return (string) $date;
        }
    }

    /**
     * Format a date in short format (e.g., 'Apr 03')
     *
     * @param mixed $date The date to format
     * @return string Formatted date (e.g., 'Apr 03')
     */
    public static function formatDateShort($date): string
    {
        return static::formatDate($date, 'M d');
    }

    /**
     * Format a date in long format (e.g., 'Wednesday, April 03, 2026')
     *
     * @param mixed $date The date to format
     * @return string Formatted date (e.g., 'Wednesday, April 03, 2026')
     */
    public static function formatDateLong($date): string
    {
        return static::formatDate($date, 'l, F d, Y');
    }

    /**
     * Format a date in full format with day name (e.g., 'Wed, 03 Apr 2026')
     *
     * @param mixed $date The date to format
     * @return string Formatted date
     */
    public static function formatDateFull($date): string
    {
        return static::formatDate($date, 'D, d M Y');
    }

    /**
     * Format a date for show display (e.g., 'D, M d')
     * Used in seat selection and booking pages
     *
     * @param mixed $date The date to format
     * @return string Formatted date (e.g., 'Wed, Apr 03')
     */
    public static function formatShowDate($date): string
    {
        return static::formatDate($date, 'D, M d');
    }

    /**
     * Format a time (e.g., '07:30 PM')
     *
     * @param mixed $time The time to format
     * @param string $format The format string (default: 'h:i A')
     * @return string Formatted time
     *
     * @example
     * formatTime($time) → '07:30 PM'
     * formatTime($time, 'H:i') → '19:30'
     */
    public static function formatTime($time, string $format = 'h:i A'): string
    {
        if (!$time) {
            return '';
        }

        try {
            return Carbon::parse($time)->format($format);
        } catch (\Exception $e) {
            \Log::warning('Time format failed for time: ' . $time, ['error' => $e->getMessage()]);
            return (string) $time;
        }
    }

    /**
     * Format time as 24-hour format (e.g., '19:30')
     *
     * @param mixed $time The time to format
     * @return string Formatted time (e.g., '19:30')
     */
    public static function formatTime24Hour($time): string
    {
        return static::formatTime($time, 'H:i');
    }

    /**
     * Format time as 12-hour format (e.g., '7:30 PM')
     *
     * @param mixed $time The time to format
     * @return string Formatted time (e.g., '7:30 PM')
     */
    public static function formatTime12Hour($time): string
    {
        return static::formatTime($time, 'h:i A');
    }

    /**
     * Format a complete datetime display (date + time)
     *
     * @param mixed $date The date to format
     * @param mixed $time The time to format
     * @return string Formatted datetime (e.g., 'Wed, 03 Apr 2026 • 7:30 PM')
     */
    public static function formatDateTime($date, $time): string
    {
        $formattedDate = static::formatDate($date, 'M d');
        $formattedTime = static::formatTime($time, 'h:i A');
        return "{$formattedDate} • {$formattedTime}";
    }

    /**
     * Format a movie release date (e.g., 'Apr 03, 2026')
     *
     * @param mixed $date The date to format
     * @return string Formatted date
     */
    public static function formatReleaseDate($date): string
    {
        return static::formatDate($date, 'M d, Y');
    }

    /**
     * Format a date for email display (e.g., 'Wednesday, April 03')
     *
     * @param mixed $date The date to format
     * @return string Formatted date
     */
    public static function formatEmailDate($date): string
    {
        return static::formatDate($date, 'l, d M Y');
    }

    /**
     * Format a date for database/API (e.g., '2026-04-03')
     *
     * @param mixed $date The date to format
     * @return string Formatted date in ISO format
     */
    public static function formatDateISO($date): string
    {
        return static::formatDate($date, 'Y-m-d');
    }

    /**
     * Format a date for admin/index display (e.g., '03 Apr 2026')
     *
     * @param mixed $date The date to format
     * @return string Formatted date
     */
    public static function formatAdminDate($date): string
    {
        return static::formatDate($date, 'd M Y');
    }

    /**
     * Format a month and year (e.g., 'Apr 2026')
     *
     * @param mixed $date The date to format
     * @return string Formatted month and year
     */
    public static function formatMonthYear($date): string
    {
        return static::formatDate($date, 'M Y');
    }
}

<?php

namespace App\Helpers;

class FileUploadHelper
{
    /**
     * Uploads the supplier invoice copy and returns the relative path.
     *
     * @param \Illuminate\Http\UploadedFile|null $file
     * @param string $directory
     * @return string|null
     */
    public static function uploadSupplierInvoiceCopy($file, $directory = 'uploads/supplier_invoices')
    {
        if ($file && $file->isValid()) {
            $path = $file->store($directory, 'public');
            // Return the relative path to be saved in 'supplier_invoice_copy' column
            return $path;
        }
        return null;
    }
}

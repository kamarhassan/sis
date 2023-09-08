<?php

namespace App\Traits;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

trait ImageStore
{
    public function saveImage($image, $height = null, $lenght = null)
    {
        try {
            if (isset($image)) {
                $domain = SaasDomain();
                $current_date = Carbon::now()->format('d-m-Y');
                if (!File::isDirectory('public/uploads/' . $domain . '/images/' . $current_date)) {
                    File::makeDirectory('public/uploads/' . $domain . '/images/' . $current_date, 0777, true, true);
                }
                if (gettype($image) != 'string' && $image->extension() == "svg") {
                    $fileName1 = md5(rand(0, 9999) . '_' . time()) . '.' . $image->clientExtension();
                    $img_name = 'public/uploads/' . $domain . '/images/' . $fileName1;
                    $image->move(public_path('uploads/images'), $fileName1);

                } else {
                    $image_extention = str_replace('image/', '', Image::make($image)->mime());
                    if ($height != null) {
                        $img = Image::make($image);
                        $img->resize($height, $lenght, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } else {
                        $img = Image::make($image);
                    }
                    $img_name = 'public/uploads/' . $domain . '/images/' . $current_date . '/' . uniqid() . '.' . $image_extention;
                    $img->save($img_name);

                }
                return $img_name;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Invalid Image Format'), trans('common.Failed'));
            return null;
        }
    }

    public function deleteImage($url)
    {
        if (isset($url)) {
            if (File::exists($url)) {
                File::delete($url);
                return true;
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

    public function saveAvatar($image, $height = null, $lenght = null)
    {
        if (isset($image)) {

            $current_date = Carbon::now()->format('d-m-Y');

            if (!File::isDirectory('uploads/avatar/' . $current_date)) {

                File::makeDirectory('uploads/avatar/' . $current_date, 0777, true, true);

            }

            $image_extention = str_replace('image/', '', Image::make($image)->mime());

            if ($height != null && $lenght != null) {
                $img = Image::make($image)->resize($height, $lenght);
            } else {
                $img = Image::make($image);
            }

            $img_name = 'uploads/avatar/' . $current_date . '/' . uniqid() . '.' . $image_extention;
            $img->save($img_name);

            return $img_name;

        } else {

            return null;
        }

    }

    public static function saveImageStatic($image, $height = null, $lenght = null)
    {
        if (isset($image)) {
            $current_date = Carbon::now()->format('d-m-Y');

            if (!File::isDirectory('uploads/images/' . $current_date)) {
                File::makeDirectory('uploads/images/' . $current_date, 0777, true, true);
            }

            $image_extention = str_replace('image/', '', Image::make($image)->mime());

            if ($height != null && $lenght != null) {
                $img = Image::make($image)->resize($height, $lenght);
            } else {
                $img = Image::make($image);
            }

            $img_name = 'uploads/images/' . $current_date . '/' . uniqid() . '.' . $image_extention;
            $img->save($img_name);
            return $img_name;
        } else {
            return null;
        }
    }

    public static function saveFile(UploadedFile $file)
    {
        if (isset($file)) {
            $current_date = Carbon::now()->format('d-m-Y');
            if (!File::isDirectory('public/uploads/images/' . $current_date)) {
                File::makeDirectory('public/uploads/images/' . $current_date, 0777, true, true);
            }
            $fileName1 = md5(rand(0, 9999) . '_' . time()) . '.' . $file->clientExtension();
            $file_name = 'public/uploads/file/' . $fileName1;
            $file->move(public_path('uploads/file'), $fileName1);
            return $file_name;
        } else {
            return null;
        }
    }

}

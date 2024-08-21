<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'route_name',
        'full_name',
        'email',
        'quotation_no',
        'phone',
        'width',
        'height',
        'embroidery_coverage',
        'backing',
        'product_quantity',
        'needby',
        'product_form_slug',
        'artwork',        // Add this line
        'artwork2',       // Add this line
        'design_format',
        'time_frame',
        'instruction',
        'placement',
        'string_color',
        'stock',
        'pvc_patch_type',
        'colors',
        'material',
        'fold',
        'bordercolor',
        'name',
        'font',
        'namecolor',
        'twillcolor',
        'type',
        'corners',
        'borderstyle',
        'shape',
        'stickersize',
        'bumper_sticker_type',
        'sticker_extra_colors',
        'basecolor',
        'embossed',
        'chenille_colors',
        'thread_colors',
        'border',
    ];
}

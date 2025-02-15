<?php

namespace App\Http\Resources\Theme;

use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            //
            'bgColour' => $this->bgColour,
            'bgTextColour' => $this->bgTextColour,
            //
            'secondBgColour' => $this->secondBgColour,
            'secondBgHoverColour' => $this->secondBgHoverColour,
            'secondColour' => $this->secondColour,
            'secondBgTextColour' => $this->secondBgTextColour,
            'secondFocusColour' => $this->secondFocusColour,
            'secondHoverColour' => $this->secondHoverColour,
            //
            'textColour' => $this->textColour,
            'textHoverColour' => $this->textHoverColour,
            'textBgHoverColour' => $this->textBgHoverColour,
            //
            'secondTextColour' => $this->secondTextColour,
            'secondTextHoverColour' => $this->secondTextHoverColour,
            //
            'thirdTextColour' => $this->thirdTextColour,
            //
            'mainButtonColour' => $this->mainButtonColour,
            'mainButtonHoverColour' => $this->mainButtonHoverColour,
            //
            'is_active' => $this->is_active,
        ];
    }
}

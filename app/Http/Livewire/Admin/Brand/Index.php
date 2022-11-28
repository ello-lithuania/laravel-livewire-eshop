<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    public $name,$slug,$status, $brand_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function rules() {
        return [
            'name'=>['required', 'string'],
            'slug'=>['required','string'],
            'status'=>['nullable'],
        ];
    }

    public function saveBrand() {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status == true ? '1' : '0',
        ]);
        session()->flash('message','Added successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }    

    public function resetInput(){
        $this->name = NULL;
        $this->status = NULL;
        $this->slug = NULL;
        $this->brand_id = NULL;
    }

    public function closeModal() {
        $this->resetInput();
    }

    public function openModal() {
        $this->resetInput();
    }

    public function updateBrand() {
        $validatedData = $this->validate();
        Brand::find($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status == true ? '1' : '0',
        ]);
        session()->flash('message','Updated successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand() {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','Deleted successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function deleteBrandModel($brand_id) {
        $this->brand_id = $brand_id;
    }
    public function editBrand($brand_id) {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
    }

    public function render()
    {
        $brands = Brand::latest()->paginate(10);
        return view('livewire.admin.brand.index', ['brands'=>$brands])
        ->extends('layouts.admin')
        ->section('content');
    }
}

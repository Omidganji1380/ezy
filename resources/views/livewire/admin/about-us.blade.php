<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0"><input type="text" class="form-control" wire:model="topTitle"
                                                wire:keyup="updateTexts"></h3>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="row g-3 mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" wire:model="infoTopTitle" wire:keyup="updateTexts">
                        </div>
                        <div class="col-6 row justify-content-between">
                            @if($firstRecord->resume)
                                <button class="btn btn-warning ms-auto w-25" wire:click="removeResume">حذف رزومه</button>
                            @else
                                <input type="file" class="btn btn-primary ms-auto w-25" wire:model="resume">
                            @endif
                            @if($firstRecord->resume)
                                <input type="text" class="form-control w-50" wire:model="resumeButton"
                                       wire:keyup="updateTexts">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="rounded-circle position-relative w-100 h-100">
                                <img src="{{asset('storage/about/infoImg/'.$firstRecord->infoImg)}}"
                                     class="position-absolute mh-100 mw-100 rounded-circle">
                                <input type="file" class="w-100 h-100 position-absolute rounded-circle opacity-0"
                                       wire:model="infoImage">
                            </div>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control my-1" wire:model="infoTitle"
                                   wire:keyup="updateTexts">
                            <input type="text" class="form-control my-1" wire:model="infoLocation"
                                   wire:keyup="updateTexts">
                            <textarea class="form-control my-1" wire:model="infoText" wire:keyup="updateTexts"
                                      rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <input type="text" class="form-control" wire:model="videoTitle" wire:keyup="updateTexts">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 mx-auto" style="height: 185px">
                            <div class="position-relative w-100 h-100">
                                <img src="{{asset('storage/about/videoImg/'.$firstRecord->videoImg)}}"
                                     class="position-absolute mh-100 mw-100">
                                <input type="file" class="w-100 h-100 position-absolute opacity-0"
                                       wire:model="videoImage">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control my-1" wire:model="videoLink"
                                   wire:keyup="updateTexts">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <input type="text" class="form-control" wire:model="midTopTitle" wire:keyup="updateTexts">
                        </div>
                        <div class="col-6 text-start">
                            <button class="btn btn-primary" wire:click="teamAdd">+</button>
                        </div>
                    </div>
                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>زیرعنوان</th>
                            <th>متن</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $i)
                            <tr>
                                <td>
                                    @if($team && $team->id==$i->id)
                                        <div class="position-relative">
                                            @if($teamImage)
                                                <img src="{{$teamImage->temporaryUrl()}}"
                                                     class="avatar lg me-2">
                                            @else
                                                <img src="{{asset('storage/about/team-'.$i->id.'/'.$i->midImg)}}"
                                                     class="avatar lg me-2">
                                            @endif
                                            <input type="file"
                                                   class="form-control position-absolute top-0 bottom-0 opacity-0"
                                                   wire:model="teamImage">
                                        </div>
                                    @else
                                        <img src="{{asset('storage/about/team-'.$i->id.'/'.$i->midImg)}}"
                                             class="avatar lg rounded me-2">
                                    @endif
                                </td>
                                <td>
                                    @if($team && $team->id==$i->id)
                                        <input type="text" class="form-control" wire:model="midTitle">
                                    @else
                                        {{$i->midTitle}}
                                    @endif
                                </td>
                                <td>
                                    @if($team && $team->id==$i->id)
                                        <input type="text" class="form-control" wire:model="midSubtitle">
                                    @else
                                        {{$i->midSubtitle}}
                                    @endif
                                </td>
                                <td>
                                    @if($team && $team->id==$i->id)
                                        <input type="text" class="form-control" wire:model="midDesc">
                                    @else
                                        {{$i->midDesc}}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                        @if($team && $team->id==$i->id)
                                            <button type="button" wire:click="teamSubmit"
                                                    class="btn btn-outline-secondary text-success">
                                                ذخیره
                                            </button>
                                            <button type="button" wire:click="clearInputs"
                                                    class="btn btn-outline-secondary deleterow text-danger">
                                                انصراف
                                            </button>
                                        @else
                                            <button type="button" wire:click="teamEdit({{$i->id}})"
                                                    class="btn btn-outline-secondary">
                                                <i class="icofont-edit text-success"></i>
                                            </button>
                                            <button type="button" wire:click="teamDelete({{$i->id}})"
                                                    onclick="confirm('حذف شود؟') || event.stopImmediatePropagation()"
                                                    class="btn btn-outline-secondary deleterow"><i
                                                    class="icofont-ui-delete text-danger"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->
    <hr>
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <input type="text" class="form-control" wire:model="skillTopTitle" wire:keyup="updateTexts">
                        </div>
                        <div class="col-6 text-start">
                            <button class="btn btn-primary" wire:click="skillAdd">+</button>
                        </div>
                    </div>
                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>درصد</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($skills as $i)
                            <tr>
                                <td>
                                    @if($skill && $skill->id==$i->id)
                                        <input type="text" class="form-control" wire:model="skillTitle">
                                    @else
                                        {{$i->skillTitle}}
                                    @endif
                                </td>
                                <td>
                                    @if($skill && $skill->id==$i->id)
                                        <input type="number" max="100" min="0" class="form-control" wire:model="skillPercentage">
                                    @else
                                        {{$i->skillPercentage}}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                        @if($skill && $skill->id==$i->id)
                                            <button type="button" wire:click="skillSubmit"
                                                    class="btn btn-outline-secondary text-success">
                                                ذخیره
                                            </button>
                                            <button type="button" wire:click="clearInputs"
                                                    class="btn btn-outline-secondary deleterow text-danger">
                                                انصراف
                                            </button>
                                        @else
                                            <button type="button" wire:click="skillEdit({{$i->id}})"
                                                    class="btn btn-outline-secondary">
                                                <i class="icofont-edit text-success"></i>
                                            </button>
                                            <button type="button" wire:click="skillDelete({{$i->id}})"
                                                    onclick="confirm('حذف شود؟') || event.stopImmediatePropagation()"
                                                    class="btn btn-outline-secondary deleterow"><i
                                                    class="icofont-ui-delete text-danger"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <input type="text" class="form-control" wire:model="bottomTopTitle" wire:keyup="updateTexts">
                        </div>
                        <div class="col-6 text-start">
                            <button class="btn btn-primary" wire:click="bottomAdd">+</button>
                        </div>
                    </div>
                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>زیر عنوان</th>
                            <th>متن</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bottoms as $i)
                            <tr>
                                <td>
                                    @if($bottom && $bottom->id==$i->id)
                                        <input type="text" class="form-control" wire:model="bottomTitle">
                                    @else
                                        {{$i->bottomTitle}}
                                    @endif
                                </td>
                                <td>
                                    @if($bottom && $bottom->id==$i->id)
                                        <input type="text" class="form-control" wire:model="bottomSubtitle">
                                    @else
                                        {{$i->bottomSubtitle}}
                                    @endif
                                </td>
                                <td>
                                    @if($bottom && $bottom->id==$i->id)
                                        <input type="text" class="form-control" wire:model="bottomText">
                                    @else
                                        {{$i->bottomText}}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                        @if($bottom && $bottom->id==$i->id)
                                            <button type="button" wire:click="bottomSubmit"
                                                    class="btn btn-outline-secondary text-success">
                                                ذخیره
                                            </button>
                                            <button type="button" wire:click="clearInputs"
                                                    class="btn btn-outline-secondary deleterow text-danger">
                                                انصراف
                                            </button>
                                        @else
                                            <button type="button" wire:click="bottomEdit({{$i->id}})"
                                                    class="btn btn-outline-secondary">
                                                <i class="icofont-edit text-success"></i>
                                            </button>
                                            <button type="button" wire:click="bottomDelete({{$i->id}})"
                                                    onclick="confirm('حذف شود؟') || event.stopImmediatePropagation()"
                                                    class="btn btn-outline-secondary deleterow"><i
                                                    class="icofont-ui-delete text-danger"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" wire:ignore.self id="expadd" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title fw-bold" id="expaddLabel">افزودن نمونه کار</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                 </div>
                 <div class="modal-body">
                     <div class="deadline-form">
                         <form>
                             <div class="row g-3 mb-3 justify-content-center">
                                 <div class="col-sm-6">
                                     <label for="taxtno" class="form-label">تصویر</label>
                                     <div class="position-relative" style="height: 200px;width: 400px">
                                         @if($portfolio)
                                             <img
                                                 src="{{asset('storage/portfolios/portfolio-'.$portfolio->id.'/'.$portfolio->img)}}"
                                                 class="position-absolute w-100 h-100">
                                         @endif
                                         @if($image)
                                             <img src="{{$image->temporaryUrl()}}"
                                                  class="position-absolute w-100 h-100">
                                         @endif
                                         <input type="File" class="position-absolute w-100 h-100 opacity-0" id="taxtno"
                                                wire:model="image">
                                     </div>
                                 </div>
                             </div>
                             <div class="row g-3 mb-3">
                                 <div class="col-sm-4">
                                     <label for="abc" class="form-label">عنوان</label>
                                     <input type="text" class="form-control" wire:model="title" id="abc">
                                 </div>
                                 <div class="col-sm-4">
                                     <label for="depo2ne" class="form-label">لینک</label>
                                     <input type="text" class="form-control" wire:model="link" id="depo2ne">
                                 </div>
                                 <div class="col-sm-4">
                                     <label for="depo3ne" class="form-label">دسته بندی</label>
                                     <select type="text" class="form-select" wire:model="category_id" id="depo3ne">
                                         <option value="">بدون دسته بندی</option>
                                         @foreach($categories as $i)
                                             <option value="{{$i->id}}">{{$i->name}}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                         </form>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                         انصراف
                     </button>
                     <button type="submit" wire:click="submit" class="btn btn-primary">{{$portfolio?'ویرایش':'افزودن'}}</button>
                 </div>
             </div>
         </div>
     </div>--}}
</div>

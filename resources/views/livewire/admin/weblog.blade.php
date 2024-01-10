<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">لیست بلاگ ها</h3>
                <button wire:click="addBlog" type="button" class="btn btn-primary btn-set-task w-sm-100">
                    <i class="icofont-plus-circle me-2 fs-6"></i>
                    افزودن
                </button>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th>وضعیت</th>
                            <th>بازدید</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $i)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/blogs/blog-'.$i->id.'/'.$i->img)}}"
                                         class="avatar lg rounded me-2" style="width: 50%;height: 50%;">
                                </td>
                                <td>{{$i->title}}</td>
                                <td>{{$i->category?$i->category->name:'-'}}</td>
                                <td>
                                    @if($i->status==0)
                                        <span wire:click="changeStatus({{$i->id}})"
                                              class="badge bg-warning">غیر فعال</span>
                                    @else
                                        <span wire:click="changeStatus({{$i->id}})" class="badge bg-primary">فعال</span>
                                    @endif
                                </td>
                                <td>{{$i->visit}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                        <a href="{{route('admin.blog.edit',$i->id)}}" wire:navigate
                                                class="btn btn-outline-secondary">
                                            <i class="icofont-edit text-success"></i>
                                        </a>
                                        <button type="button" wire:click="delete({{$i->id}})"
                                                wire:confirm="حذف شود؟"
                                                class="btn btn-outline-secondary deleterow"><i
                                                class="icofont-ui-delete text-danger"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{$blogs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->

{{--
    <div class="modal fade" wire:ignore.self id="expadd" tabindex="-1" aria-hidden="true">
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
    </div>
--}}
</div>

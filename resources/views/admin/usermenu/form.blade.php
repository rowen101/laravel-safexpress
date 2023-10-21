<form id="productForm" name="productForm" class="form-horizontal">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-12" id="accordion">
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="control-label">UserID</label>
                                    <input type="text" class="form-control" name="id" id="txtid"
                                        placeholder="User ID">
                                </div>
                                @foreach ($adminmenu as $item)
                                    @if (count($item->submenus) > 0)
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="menu_id[]" value="{{ $item->id }}" id="menu_id_{{ $item->id }}" class="custom-control-input menu-checkbox" />
                                                        <label class="custom-control-label" name="menu_id" for="menu_id_{{ $item->id }}">  <a class="d-block w-100" data-toggle="collapse"
                                                        href="#{{ $item->menu_title }}">
                                                        {{ $item->menu_title }}</a></label>

                                                    </div>

                                                </h4>
                                            </div>

                                            <div id="{{ $item->menu_title }}" class="collapse show"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                    <ul class="list-group">
                                                        @foreach ($item->submenus as $submenu)
                                                            <li class="list-group-item">
                                                                <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="menu_id[]" value="{{ $submenu->id }}" id="menu_id_{{ $submenu->id }}" class="custom-control-input menu-checkbox" />
                                                                <label class="custom-control-label" name="menu_id" for="menu_id_{{ $submenu->id }}">{{ $submenu->menu_title }}</label>

                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card card-primary card-outline">

                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="menu_id[]" value="{{ $item->id }}" id="menu_id_{{ $item->id }}" class="custom-control-input menu-checkbox" />
                                                    <label class="custom-control-label" name="menu_id" for="menu_id_{{ $item->id }}">{{ $item->menu_title }}</label>
                                                </div>
                                                </h4>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- Hidden field to store the user ID for update -->
                            <input type="hidden" id="txtid" name="id" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<form id="productForm" name="productForm" class="form-horizontal">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="exampleInputEmail1" class="control-label">User Name</label>
                                        <input type="text"  class="form-control" name="name"  id="name" id="exampleInputEmail1" placeholder="User Name" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
                                      </div>
                                    <div class="form-group required">
                                        <label for="exampleInputPassword1" class="control-label">First Name</label><span class="text-danger" id="first_nameErrorMsg"></span>
                                        <input type="text"  class="form-control" name="first_name" id="first_name"    placeholder="First Name" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                      </div>
                                      <div class="form-group required">
                                        <label for="exampleInputPassword1" class="control-label">Last Name</label><span class="text-danger" id="last_nameErrorMsg"></span>
                                        <input type="text" class="form-control" name="last_name"  id="last_name"  placeholder="Last Name" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                      </div>


                                      <div class="form-group required">
                                        <label for="exampleInputEmail1" class="control-label">Role</label>
                                        <select class="custom-select rounded-0" name="role" id="role">
                                            <option value="0" >--Select Role--</option>
                                            @foreach ($role as $item)
                                                 <option value="{{ $item->id}}">{{ $item->role_code}}</option>
                                            @endforeach
                                          </select>
                                          <input type="hidden" id="role_id" value="role_id" name="role_id"/>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="exampleInputPassword1" class="control-label">User Description</label>
                                        <input type="text"class="form-control" name="user_type" id="user_type"   placeholder="User Description" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                      </div>
                                    <div class="form-group required">
                                        <label for="exampleInputPassword1" class="control-label">Email</label>
                                        <span class="text-danger" id="emailErrorMsg"></span>
                                        <input type="text"class="form-control" name="email" id="email"   placeholder="Email" aria-describedby="exampleInputPassword1-error" aria-invalid="true">

                                      </div>
                                      <div class="form-group required">

                                        <label for="exampleInputPassword1" >Password</label><label id="clabel">&nbsp;<i>Note: if you don't update the password make it blank</i></label>
                                        <input type="password"  class="form-control" name="password" id="password"   placeholder="Password" aria-describedby="exampleInputPassword1-error" aria-invalid="true">

                                      </div>
                                      <div class="form-group mb-0">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="is_active" id="is_active" value=""
                                                class="custom-control-input" aria-invalid="true" />

                                            <label class="custom-control-label" name="is_active" for="is_active">Active: <div
                                                    id="is_active"></div></label>
                                        </div>

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

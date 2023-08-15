<form action="{{ route('admin.student.index') }}" method="get">
<div class="search-form">
    <div class="row">                                
        <div class="col-lg-3 col-md-6">  
            <div class="form-group">
                <input type="text" class="form-control" name="search_phone" placeholder="Search by phone number">
            </div>
        </div>
        
        <div class="col-lg-2">  
            <div class="search-student-btn">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</div>
</form>
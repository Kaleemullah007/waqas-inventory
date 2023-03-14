<div class="row mb-2 justify-content-between">
    <div class="col-lg-4 col-md-6 col-12 mt-2 d-flex">
        <span class="mt-1">{{__('en.Rows Per Page')}} :</span>
        <select class="form-select bg-grey w-50 ms-2 border-secondary">
            <option selected>10</option>
            <option value="1">20</option>
            <option value="2">30</option>
            <option value="3">50</option>
            <option value="4">{{__('en.All')}}</option>
        </select>
    </div>
    <div class="col-lg-3 col-md-4 col-12 mt-2">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
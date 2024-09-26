<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Customer</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <div class="table-responsive">
                <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>

<script>

getList();


async function getList() {

    showLoader();
    let res=await axios.get("/list-customer");
    hideLoader();
    let tableList=$("#tableList");
    let tableData=$("#tableData");
    tableData.DataTable().destroy();
    tableList.empty();

    res.data.forEach(function(item,index){
        let row=
        `<tr>
            <td>${index+1}</td>
            <td>${item["name"]}</td>
            <td>${item["email"]}</td>
            <td>${item["mobile"]}</td>
            <td class=" text-wrap">${item["address"]}</td>
             <td class="text-center">
                <button data-id="${item['id']}" class="btn  editBtn btn-sm btn-success">Edit</button>
                <button data-id="${item['id']}" class="btn   deleteBtn btn-sm btn-danger">Delete</button>
             </td>
        </tr>`

        tableList.append(row)
    })

    $(".deleteBtn").on("click",function () {

        let id=$(this).data("id");
        $("#delete-modal-customer").modal("show");
        $("#deleteID-c").val(id);
    })

    $(".editBtn").on("click",async function () {

        let id=$(this).data("id");
        await FillUpUpdateForm(id);
        $("#update-modal").modal("show");
    })

    tableData.DataTable({
        order:[[0,"asc"]],
        lengthMenu: [5,10,15,20, 25, 50,"All"]
    });

}


</script>


<?php include 'header.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Category
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
            
            <form action=" " method="POST" class="form-inline" role="form">
            
                <div class="form-group">
                    <input type="email" class="form-control" id="" placeholder="Input field">
                </div>
            
                
            
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                <a href="category-create.php" type="submit" class="btn btn-success"><i class="fa fa-plus">Add new</i></a>
            </form>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Bánh mì pate</td>
                        <td>Còn hàng</td>
                        <td class="text-right">
                            <a href="" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i>Edit</a>
                            <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Del</a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bánh mì pate</td>
                        <td>Còn hàng</td>
                        <td class="text-right">
                            <a href="" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i>Edit</a>
                            <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Del</a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bánh mì pate</td>
                        <td>Còn hàng</td>
                        <td class="text-right">
                            <a href="" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i>Edit</a>
                            <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Del</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </section>
</div>
<?php include "footer.php" ?>
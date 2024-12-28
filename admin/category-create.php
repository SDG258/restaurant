<?php include 'header.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Create Category
        </h1>
    </section>
    <section class="content">
        <div class="box">

            <div class="box-body">
                
                <form action="" method="POST" role="form">                
                    <div class="form-group">
                        <label for="">Name Category</label>
                        <input type="text" class="form-control" id="name" placeholder="Input Name">
                    </div>

                    <div class="form-group">
                        <label for="">Name Category</label>
                        
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="1" checked="checked">
                                Show
                            </label>
                            <label>
                                        <input type="radio" name="status" value="0">
                                Hiddent
                            </label>                          
                        </div>
                    </div>
                
                    
                
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    <a href="category-create.php" type="submit" class="btn btn-success"><i class="fa fa-plus">Add new</i></a>

                </form>
                
            </div>
        </div>
                        
    </section>
</div>
<?php include "footer.php" ?>
<div class="card shadow mb-4">

    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><a href="?action=add" class="btn btn-primary">Add Product</a></h6>
        <!-- <h6 class="m-0 font-weight-bold text-primary btn-group">
            <a href="?action=add" class="btn btn-primary">Add Category</a>
            <a href="?action=add" class="btn btn-success">Edit Category</a>
            <a href="?action=add" class="btn btn-danger">Delete Category</a>
        </h6> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale</th>
                        <th>description</th>
                        <th>image</th>
                        <th>category</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale</th>
                        <th>description</th>
                        <th>image</th>
                        <th>category</th>
                        <th>Control</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $myId = 0;;

                    require_once "functions/connect.php";
                    $products = $conn->query("SELECT * FROM products");
                    foreach ($products as $product) :
                        $images = $conn->query("SELECT name FROM images WHERE pro_id='$product[id]'")->fetch_assoc();
                        $image = explode(",", $images["name"]);
                    ?>
                        <!-- Modal -->
                        <div class="modal fade" id="model<?= $product["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        are you sure you want to remove this product ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="functions/products/delete_product.php?id=<?= $product["id"] ?>" type="button" class="btn btn-danger">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tr>
                            <td><?= ++$myId ?></td>
                            <td><?= $product["name"] ?></td>
                            <td><?= $product["price"] ?></td>
                            <td><?= $product["sale"] ?></td>
                            <td><?= $product["description"] ?></td>
                            <td><img src="img/<?= $image[0] ?>" alt="product_image" style="width: 70px"></td>
                            <td><?php
                                $id = $product["cat_id"];
                                $query = $conn->query("SELECT name FROM category WHERE id='$id'")->fetch_assoc();

                                echo $query["name"];
                                ?></td>
                            <td>
                                <a href="?action=edit&id=<?= $product["id"] ?>" class="btn btn-primary btn-sm w-100">edit</a>
                                <a type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#model<?= $product["id"] ?>">
                                    delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="new_title">
    DANH SÁCH SÁCH
    <a href="<?php echo site_url();?>seller/Book/addBook" title="Thêm thành viên mới"
       class="btn btn-default navbar-right" style="width: 120px;margin-left: 5px">
        <span class="fa fa-plus"></span>
    </a>
</div>
<div class="row">
    <div class="col-md-2 filter">
        <div class="form-group">
            <form action="<?php echo site_url().'seller/Book/viewListBook'; ?>" method="get">
            <label for="search-name">Tìm theo tên sách:</label>
            <div class="input-group">
                <input id="kw" name="kw" value="<?php echo set_value('kw'); ?>" type="text" class="form-control" placeholder="Nhập tên sách...">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" id="searchByName"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
        <div class="form-group">
            <form action="<?php echo site_url().'seller/Book/viewListBook'; ?>" method="get">
            <label for="search-type">Lọc danh mục:</label>
            <div class="input-group">
                <select id="kt" name="kt" class="form-control">
                    <option value="0">Chọn danh mục</option>
                    <?php foreach ($type as $type): ?>
                    <option value="<?php echo $type['typeID'] ?>"<?php echo set_select('kt', $type['typeID']); ?>><?php echo $type['typeName'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" id="searchByType"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#searchByName').click(function (){
                if ($('#kw').val().trim() === "") {
                    alert("Mời bạn nhập tên sách cần tìm kiếm");
                    return false;
                } else {
                    return true;
                }
            });
            $('#searchByType').click(function (){
                if ($('#kt').val().trim() === "0") {
                    alert("Mời bạn chọn danh mục cần tìm kiếm");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
    <div class="col-md-10" id="list-book">
        <table class="table-bordered" style="width: 100%;">
            <thead style="background: #33ffcc;">
                <tr>
                    <th width = "3%">STT</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th width = "25%">Tóm tắt</th>
                    <th>Nhà xuất bản</th>
                    <th>Năm xuất bản</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th width = "4%">Sửa</th>
                    <th width = "4%">Xóa</th>
                </tr>
            </thead>
            <tbody style="background: transparent">
                <?php if ($book == NULL){ ?>
                <tr>
                    <td colspan="10" height="100" align="center">Chưa có dữ liệu sách</td>
                </tr>
                <?php } else {?>
                    <tr class="sort-book">
                        <td></td>
                        <td align="center">
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=ascname'; ?>">
                                <span class="fa fa-caret-up"></span>
                            </a>
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=descname'; ?>">
                                <span class="fa fa-caret-down"></span>
                            </a>
                        </td>
                        <td align="center">
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=ascaut'; ?>">
                                <span class="fa fa-caret-up"></span>
                            </a>
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=descaut'; ?>">
                                <span class="fa fa-caret-down"></span>
                            </a>
                        </td>
                        <td></td>
                        <td align="center">
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=ascpub'; ?>">
                                <span class="fa fa-caret-up"></span>
                            </a>
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=descpub'; ?>">
                                <span class="fa fa-caret-down"></span>
                            </a>
                        </td>
                        <td align="center">
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=ascypub'; ?>">
                                <span class="fa fa-caret-up"></span>
                            </a>
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=descypub'; ?>">
                                <span class="fa fa-caret-down"></span>
                            </a>
                        </td>
                        <td></td>
                        <td align="center">
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=ascprice'; ?>">
                                <span class="fa fa-caret-up"></span>
                            </a>
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=descprice'; ?>">
                                <span class="fa fa-caret-down"></span>
                            </a>
                        </td>
                        <td align="center">
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=ascqty'; ?>">
                                <span class="fa fa-caret-up"></span>
                            </a>
                            <a href="<?php echo site_url().'seller/Book/viewListBook?sort=descqty'; ?>">
                                <span class="fa fa-caret-down"></span>
                            </a>
                        </td>
                        <td></td>
                        <td align="center"><a href="<?php echo site_url().'seller/Book/viewListBook'; ?>">
                                <span class="fa fa-minus-circle"></span>
                            </a>
                        </td>
                    </tr>
                <?php foreach ($book as $value): ?>
                    <tr>
                        <td align="center"><?php echo $per_page++;?></td>
                        <td><?php echo stripslashes(word_limiter($value['bookName'],6,'...'))?></td>
                        <td><?php echo stripslashes($value['author'])?></td>
                        <td><?php echo stripslashes(word_limiter($value['bookContent'],15,'...'))?></td>
                        <td><?php echo stripslashes($value['publisher'])?></td>
                        <td align="center"><?php ($value['yearOfPublication'] == '0')?$year = '---':$year = $value['yearOfPublication'];
                                echo $year;?></td>
                        <td><?php echo $value['typeName']?></td>
                        <td><?php echo '$'.$value['bookPrice']?></td>
                        <td align="center"><?php echo $value['bookQuantity']?></td>
                        <td align="center">
                            <a href="<?php echo site_url();?>seller/Book/editBook/<?php echo $value['bookID'] ?>">
                                <span class="glyphicon glyphicon-edit"></span></a></td>
                        <td align="center">
                            <a href="<?php echo site_url();?>seller/Book/deleteBook/<?php echo $value['bookID'] ?>"
                               onClick="return confirm('Bạn muốn xóa sách <?php echo $value['bookName']; ?>?')">
                            <span class="glyphicon glyphicon-remove-circle"</a>
                        </td>
                    </tr>
                <?php endforeach; }?>
            </tbody>
        </table>
        <div class="col-md-12" style="text-align: center;">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
<style type="text/css">
    .sort-book a{color: #9acfea}
    .sort-book a:hover{color: blue}
</style>
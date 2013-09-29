
        <div class="row-fluid">
            <div class="span12">

                <div class="backdrop">

                    <section class="breadcrumb">

                        <ul class="breadcrumb">
                            <li><a href="/"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
                            <li class="active"><i class="icon-wrench"></i> Admin</li>
                        </ul>

                    </section>

                </div>

                <div class="backdrop">

                    <section class="admin">

                        <table class="table table-striped">

                            <thead>
                                <tr>
                                    <th><i class="icon-list"></i> Category</th>
                                    <th><i class="icon-th"></i> Quantity</th>
                                    <th><i class="icon-time"></i> Last Update</th>
                                </tr>
                            </thead>

                            <tbody>
                                    
                                <tr>
                                    <td class="name"><a href="/admin/boils" class="btn btn-block btn-success"><i class="icon-wrench icon-white"></i> Boils</a></td>
                                    <td class="quantity"><?= $numBoils ?></td>
                                    <td class="datetime"><?= $lastUpdated['boils'] ?></td>
                                </tr>

                                <tr>
                                    <td class="name"><a href="/admin/prices" class="btn btn-block btn-success"><i class="icon-wrench icon-white"></i> Prices</a></td>
                                    <td class="quantity"><?= $numPrices ?></td>
                                    <td class="datetime"><?= $lastUpdated['prices'] ?></td>
                                </tr>

                            </tbody>

                        </table>

                    </section>

                </div>

            </div>
        </div>

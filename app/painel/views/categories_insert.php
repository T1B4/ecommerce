<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary" style="box-shadow: 3px 3px 6px rgba(0,0,0,0.15);">

        <?php if (isset($mensagem['principal'])): ?>
            <div class="alert alert-success" id="mensagem" style="margin: 20px;">
                <h3><?php echo $mensagem['principal']; ?></h3>
            </div>
        <?php endif; ?>

        <div class="box-header with-border">
            <h3 class="box-title">Inserir Nova Categoria de Produtos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            <div class="box-body">

                <div class="form-group">
                    <label for="name">Ttulo da Categoria</label>
                    <input type="text" class="form-control" name="name" placeholder="Insira o titulo da categoria" required>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>

<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary" style="box-shadow: 3px 3px 6px rgba(0,0,0,0.15);">

        <?php if (isset($mensagem['subcategoria'])): ?>
            <div class="alert alert-success" id="mensagem" style="margin: 20px;">
                <h3><?php echo $mensagem['subcategoria']; ?></h3>
            </div>
        <?php endif; ?>

        <div class="box-header with-border">
            <h3 class="box-title">Inserir Nova Sub-Categoria de Produtos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            <div class="box-body">

                <div class="form-group">
                    <label for="category">Categorias Cadastradas</label>
                    <select class="form-control" name="category">
                        <option value="">Selecione a Categoria Principal</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value=""></option>
                            <option value="<?php echo $cat['id']; ?>"><b><?php echo strtoupper($cat['name']); ?></b></option>
                            <?php if (count($cat['subs']) > 0): ?>
                                <?php foreach ($cat['subs'] as $subcat): ?>
                                    <option value="<?php echo $subcat['id']; ?>"> -- <?php echo $subcat['name']; ?></option>
                                    <?php if (count($subcat['subs']) > 0): ?>
                                        <?php foreach ($subcat['subs'] as $subsubcat): ?>
                                            <option value="<?php echo $subsubcat['id']; ?>"> --- <?php echo $subsubcat['name']; ?></option>
                                        <?php endforeach ?>
                                        <option value=""></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Ttulo da Sub-Categoria</label>
                    <input type="text" class="form-control" name="name" placeholder="Insira o titulo da categoria" required>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>

<div style="clear: both;"></div>

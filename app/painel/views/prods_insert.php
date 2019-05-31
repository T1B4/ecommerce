<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary" style="box-shadow: 3px 3px 6px rgba(0,0,0,0.15);">

        <?php if (isset($mensagem)): ?>
<!--             <div id="mensagem">
                <h3 class="alert alert-success" style="margin: 0 10px;"><?php echo $mensagem; ?></h3>
            </div> -->

            <script>
                    alert("<?php echo $mensagem; ?>")
          </script>
      <?php endif ?>

      <div class="box-header with-border">
        <h3 class="box-title">Inserir Novo Produto</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" enctype="multipart/form-data" method="POST">
        <div class="box-body">
            <div class="form-group">
                <label for="name">Categorias</label>
                <select name="category" class="form-control">
                    <option value="">Selecione uma Categoria para o Produto</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                        <?php if (count($cat['subs']) > 0): ?>
                            <?php foreach ($cat['subs'] as $subcat): ?>
                                <option value="<?php echo $subcat['id']; ?>"> -- <?php echo $subcat['name']; ?></option>
                                    <?php foreach ($subcat['subs'] as $subcatcat): ?>
                                        <option value="<?php echo $subcatcat['id']; ?>"> -- <?php echo $subcatcat['name']; ?></option>
                                    <?php endforeach?>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Marcas</label>
                <select name="brand" class="form-control">
                    <option value="">Selecione o fabricante do Produto</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?php echo $brand['id'] ?>"><?php echo $brand['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="code">Código</label>
                <input type="text" class="form-control" name="code" placeholder="Insira o código do produto" required>
            </div>
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" placeholder="Insira o nome do produto" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" name="description" id="editor" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="stock">Estoque</label>
                <input type="number" class="form-control" name="stock" placeholder="Insira o estoque inicial" required>
            </div>
            <div class="form-group">
                <label for="shipping_days">Prazo de Entrega</label>
                <input type="number" class="form-control" name="shipping_days" placeholder="Qual o prazo de entrega?" required>
            </div>
            <div class="form-group">
                <label for="price">Preço à Vista</label>
                <input type="text" class="form-control" name="price" placeholder="Insira o preço do produto" required>
            </div>
            <div class="form-group">
                <label for="price_from">Preço à Prazo</label>
                <input type="text" class="form-control" name="price_from" placeholder="Insira o preço anterior do produto" >
                <input type="hidden" name="new_product" value="1">
            </div>

            <div class="form-group">
                <label for="weight">Peso</label>
                <input type="text" class="form-control" name="weight" placeholder="Insira o peso do produto" required>
            </div>

            <div class="form-group">
                <label for="length">Comprimento</label>
                <input type="text" class="form-control" name="length" placeholder="Insira o comprimento do produto" required>
            </div>

            <div class="form-group">
                <label for="width">Largura</label>
                <input type="text" class="form-control" name="width" placeholder="Insira a largura do produto" required>
            </div>

            <div class="form-group">
                <label for="height">Altura</label>
                <input type="text" class="form-control" name="height" placeholder="Insira a altura do produto" required>
            </div>

            <div class="form-group">
                <label for="diameter">Diametro</label>
                <input type="text" class="form-control" name="diameter" placeholder="Insira o diametro do produto se houver" >
            </div>


            <div class="form-group">
                <h2>Opções Disponíveis para o Produto</h2><br>
                <?php foreach ($options as $option): ?>
                    <label><?php echo $option['name'] ?></label>
                    <input type="text" class="form-control" name="option[<?php echo $option['id'] ?>]" placeholder="Insira o valor para essa opção" >
                    <hr>
                <?php endforeach ?>
            </div>

            <div class="form-group">
                <label for="featured">Classificação e Destaque do Produto</label><br>

                <label class="checkbox-inline">
                    <input type="checkbox" name="sale" value="1">Produto em Promoção
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="featured" value="1">Produto em Destaque
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="bestseller" value="1">Produto Mais Vendido
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="fretegratis" value="1">Frete Grátis
                </label>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Selecionar Imagens</label>
                <input type="file" multiple name="images[]">
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>
</div>

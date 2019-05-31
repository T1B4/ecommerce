<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary">

        <?php if (isset($mensagem)): ?>
            <div id="mensagem">
                <h3 class="alert alert-success" style="margin: 0 10px;"><?php echo $mensagem; ?></h3>
            </div>
        <?php endif ?>

        <div class="box-header with-border">
            <h3 class="box-title">Editar Produto</h3>
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
                            <?php ($cat['id'] == $prod['id_category'])? $cond = "selected": $cond = ""; ?>
                            <option value="<?php echo $cat['id'] ?>"  <?= $cond; ?>><?php echo $cat['name'] ?></option>
                            <?php if (count($cat['subs']) > 0): ?>
                                <?php foreach ($cat['subs'] as $subcat): ?>
                                    <?php ($subcat['id'] == $prod['id_category'])? $cond = "selected": $cond = ""; ?>
                                    <option value="<?php echo $subcat['id']; ?>" <?= $cond; ?>> -- <?php echo $subcat['name']; ?></option>
                                        <?php foreach($subcat['subs'] as $subcatcat): ?>
                                            <?php ($subcatcat['id'] == $prod['id_category']) ? $cond = "selected" : $cond = ""; ?>
                                            <option value="<?php echo $subcatcat['id']; ?>" <?= $cond; ?>> ### <?php echo $subcatcat['name']; ?></option>
                                        <?php endforeach; ?>
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
                            <?php ($brand['id'] == $prod['id_brand'])? $cond = "selected": $cond = ""; ?>
                            <option value="<?php echo $brand['id'] ?>" <?= $cond; ?>><?php echo $brand['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="code">Código</label>
                    <input type="text" class="form-control" name="code" placeholder="Insira o código do produto" value="<?php echo $prod['code'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" placeholder="Insira o nome do produto" value="<?php echo $prod['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea class="form-control" name="description" id="editor" rows="10"><?php echo $prod['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="stock">Estoque</label>
                    <input type="number" class="form-control" name="stock" placeholder="Insira o estoque inicial" value="<?php echo $prod['stock'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="shipping_days">Prazo de Entrega</label>
                    <input type="number" class="form-control" name="shipping_days" placeholder="Qual o prazo de entrega?"  value="<?php echo $prod['shipping_days'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="text" class="form-control" name="price" placeholder="Insira o preço do produto" value="<?php echo $prod['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price_from">Preço anterior</label>
                    <input type="text" class="form-control" name="price_from" placeholder="Insira o preço anterior do produto" value="<?php echo $prod['price_from']; ?>" required>
                    <input type="hidden" name="new_product" value="1">
                </div>

                <div class="form-group">
                    <label for="weight">Peso</label>
                    <input type="text" class="form-control" name="weight" placeholder="Insira o peso do produto" value="<?php echo number_format($prod['weight'], 2, ',', '.'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="length">Comprimento</label>
                    <input type="text" class="form-control" name="length" placeholder="Insira o comprimento do produto" value="<?php echo $prod['length'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="width">Largura</label>
                    <input type="text" class="form-control" name="width" placeholder="Insira a largura do produto" value="<?php echo $prod['width'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="height">Altura</label>
                    <input type="text" class="form-control" name="height" placeholder="Insira a altura do produto" value="<?php echo $prod['height'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="diameter">Diametro</label>
                    <input type="text" class="form-control" name="diameter" placeholder="Insira o diametro do produto se houver" value="<?php echo $prod['diameter'] ?>" required>
                </div>

                <div class="form-group">
                    <h2>Opções Disponíveis para o Produto</h2>

                    <?php foreach ($options as $option): ?>

                        <?php (isset($option['valor']) && !empty($option['valor']))? $value = $option['valor']: $value = ''; ?>

                        <label><?php echo $option['name']; ?></label>
                        <input type="text" class="form-control" name="option[<?php echo $option['id']; ?>]" value="<?php echo $value; ?>" placeholder="Insira o valor para essa opção" >
                        <br>

                    <?php endforeach ?>

                </div>

                <div class="form-group">
                    <label for="featured">Classificação e Destaque do Produto</label><br>

                    <label class="checkbox-inline">
                        <?php ($prod['sale'] == 1)? $cond = "checked": $cond = ""; ?>
                        <input type="checkbox" name="sale" value="1" <?= $cond; ?>>Produto em Promoção
                    </label>
                    <label class="checkbox-inline">
                        <?php ($prod['featured'] == 1)? $cond = "checked": $cond = ""; ?>
                        <input type="checkbox" name="featured" value="1" <?= $cond; ?>>Produto em Destaque
                    </label>
                    <label class="checkbox-inline">
                        <?php ($prod['bestseller'] == 1)? $cond = "checked": $cond = ""; ?>
                        <input type="checkbox" name="bestseller" value="1" <?= $cond; ?>>Produto Mais Vendido
                    </label>
                    <label class="checkbox-inline">
                        <?php ($prod['frete'] == 1)? $cond = "checked": $cond = ""; ?>
                        <input type="checkbox" name="fretegratis" value="1" <?= $cond; ?>>Frete Grátis
                    </label>
                </div>

                <hr>

                <div class="form-group">
                    <h3>Imagens</h3>
                    <div>Para eliminar qualquer imagem do sistema basta clicar no X no canto superior direito da imagem.</div><br>
                    <?php ($prod['id'] < 10)? $cc = 0: $cc = ''; ?>
                    <?php foreach ($prod['imagens'] as $image): ?>
                        <div class="col-xs-2">

                            <img src="<?php echo BASE_MEDIA; ?><?php echo $cc.$prod['id']."/".$image['url']; ?>" style="width: 200%; max-width: 200%; height: auto; margin-bottom: 10px; position: relative;">

                            <span><a href="<?php echo BASE_PAINEL ?>products/delimage/<?php echo $image['url']; ?>"><img src="<?php echo BASE_URL ?>assets/img/error.png" alt="Editar" title="Editar Produto" height="20" style="position: absolute; right: -45px; top: -10px;"></a></span>

                        </div>
                    <?php endforeach ?>
                </div>

                <div style="clear: both;"></div>

                <hr>

                <div class="form-group">
                    <h3>Enviar Novas Imagens</h3>
                    <input type="file" multiple name="images[]">
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
        </form>
    </div>
</div>

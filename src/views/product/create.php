<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
</head>
<body>
    <h1 class="text-center" >Gerenciar Produtos</h1>

    <main>
        <div class="container" style="max-width: 500px;">
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
            
            <form class="" action="/" method="post">
                <legend class="text-center">Crie um novo produto</legend>
                <div id="data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= htmlspecialchars($data['name'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" 
                               value="<?= htmlspecialchars($data['price'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Estoque</label>
                        <input type="number" step="1" class="form-control" id="stock" name="stock" 
                               value="<?= htmlspecialchars($data['stock'] ?? '') ?>" required>
                    </div>
                </div>
                <div id="buttons">
                    <span id="newVariation" class="btn btn-success"> Adicionar variações</span>
                    <button type="submit" class="btn btn-primary">Criar Produto</button>
                </div>
            </form>
        </div>

        <div class="container">
            <?php if (!empty($products)) : ?>
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aqui você pode adicionar dinamicamente as variações do produto -->
                        <tr>
                            <?php foreach ($products as $product) : ?>
                                <td><?= htmlspecialchars($product['produto_nome']) ?></td>
                                <td>R$ <?= number_format($product['produto_preco'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($product['produto_quantidade']) ?></td>
                                <td>
                                <button id="change" data-id="<?= htmlspecialchars($product['produto_id']) ?>">Alterar</button>
                                <button id="buy" data-id="<?= htmlspecialchars($product['produto_id']) ?>">Comprar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning m-5">
                    Nenhum produto encontrado.
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        document.getElementById('newVariation').addEventListener('click', function() {
            const dataDiv = document.getElementById('data');
            const variationDiv = document.createElement('div');
            variationDiv.className = 'mb-3';
            variationDiv.innerHTML = `
                <div class="bg-light p-2 rounded">
                    <label for="variation_name" class="form-label">Variação</label>
                    <input type="text" class="form-control" name="variation[name][]" required>
                    <label for="variation_price" class="form-label">Preço da Variação (opcional)</label>
                    <input type="number" step="0.01" class="form-control" name="variation[price][]">
                    <label for="variation_stock" class="form-label">Estoque da Variação</label>
                    <input type="number" step="1" class="form-control" name="variation[stock][]" required>
                </div>
            `;
            dataDiv.appendChild(variationDiv);
        })
    </script>
</body>
</html>
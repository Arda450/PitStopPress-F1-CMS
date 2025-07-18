            <?php if (!empty($success)): ?>
                <div class="messages">
                    <p class="success"><?= htmlspecialchars($success) ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="messages">
                    <?php foreach ($errors as $error): ?>
                        <p class="error"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
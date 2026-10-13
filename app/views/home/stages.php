<?php include_once(ROOT_DIR . 'app/views/includes/header.php'); ?>

<h2 class="stages-page-h2">Liste des stages</h2>

<div class="stages-content-wrapper">
    <div id="notification" style="display: none; padding: 15px; margin-bottom: 20px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;"></div>

    <?php if (isset($_SESSION['typecompte']) && $_SESSION['typecompte'] == 3): ?>
        <button id="btnAjouter" class="cardStyle" style="margin-bottom: 20px; padding: 10px 20px; cursor: pointer;">
            Ajouter un stage
        </button>

        <div id="formAjout" class="cardStyle" style="display: none; margin-bottom: 20px; padding: 20px;">
            <h3>Ajouter un nouveau stage</h3>
            <form id="stageForm" method="POST" action="?url=stageController">
                <input type="hidden" name="action" value="ajouter">
                <?php echo csrfField(); ?>            
                <fieldset class="stage-form-group">
                    <legend>Étudiant</legend>
                    <div class="stage-form-grid">
                        <div>
                            <label for="stage-nom">Nom</label>
                            <input type="text" id="stage-nom" name="nom" required>
                        </div>
                        <div>
                            <label for="stage-prenom">Prénom</label>
                            <input type="text" id="stage-prenom" name="prenom" required>
                        </div>
                        <div>
                            <label for="stage-datedebut">Date de début</label>
                            <input type="date" id="stage-datedebut" name="datedebut" required>
                        </div>
                        <div>
                            <label for="stage-datefin">Date de fin</label>
                            <input type="date" id="stage-datefin" name="datefin" required>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="stage-form-group">
                    <legend>Entreprise</legend>
                    <div class="stage-form-grid">
                        <div class="span-2">
                            <label for="stage-entreprise">Nom de l'entreprise</label>
                            <input type="text" id="stage-entreprise" name="entreprise" required>
                        </div>
                        <div class="span-2">
                            <label for="stage-adresse">Adresse</label>
                            <input type="text" id="stage-adresse" name="adresse" required>
                        </div>
                        <div>
                            <label for="stage-cp">Code postal</label>
                            <input type="text" id="stage-cp" name="cp" required>
                        </div>
                        <div>
                            <label for="stage-ville">Ville</label>
                            <input type="text" id="stage-ville" name="ville" required>
                        </div>
                        <div>
                            <label for="stage-teletravail">Télétravail</label>
                            <select id="stage-teletravail" name="teletravail" required>
                                <option value="0">Non</option>
                                <option value="1">Oui</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="stage-form-group">
                    <legend>Tuteur</legend>
                    <div class="stage-form-grid">
                        <div class="span-2">
                            <label for="stage-tuteur">Nom du tuteur</label>
                            <input type="text" id="stage-tuteur" name="tuteur" required>
                        </div>
                        <div>
                            <label for="stage-mailtuteur">E-mail</label>
                            <input type="email" id="stage-mailtuteur" name="mailtuteur" required>
                        </div>
                        <div>
                            <label for="stage-teltuteur">Téléphone</label>
                            <input type="tel" id="stage-teltuteur" name="teltuteur" required>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="stage-form-group">
                    <legend>Mission</legend>
                    <div class="stage-form-grid">
                        <div class="span-2">
                            <label for="stage-sujet">Sujet</label>
                            <textarea id="stage-sujet" name="sujet" rows="3" required></textarea>
                        </div>
                        <div class="span-2">
                            <label for="stage-taches">Tâches</label>
                            <textarea id="stage-taches" name="taches" rows="3" required></textarea>
                        </div>
                    </div>
                </fieldset>
                <div style="margin-top: 15px;">
                    <button type="submit" class="cardStyle" style="padding: 10px 20px; cursor: pointer; margin-right: 10px;">
                        Enregistrer
                    </button>
                    <button type="button" id="btnAnnuler" class="cardStyle" style="padding: 10px 20px; cursor: pointer;">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<div id="stagesHeader" class="cardStyle stage-line<?php echo (isset($_SESSION['typecompte']) && $_SESSION['typecompte'] == 3) ? ' with-actions' : ''; ?>">
    <span>Date début</span>
    <span>Date fin</span>
    <span>Télétravail</span>
    <span>Entreprise</span>
    <span>Adresse</span>
    <span>Code postal</span>
    <span>Ville</span>
    <span>Tuteur</span>
    <span>Email tuteur</span>
    <span>Téléphone tuteur</span>
    <span>Sujet</span>
    <span>Tâches</span>
    <?php if (isset($_SESSION['typecompte']) && $_SESSION['typecompte'] == 3): ?>
        <span>Actions</span>
    <?php endif; ?>
</div>

<div id="stagesContainer">
    <template id="stageTemplate">
        <div class="cardStyle stage-line" data-stage-id="">
            <span class="lis_datedebut"></span>
            <span class="lis_datefin"></span>
            <span class="lis_teletravail"></span>
            <span class="lis_entreprise"></span>
            <span class="lis_adresse"></span>
            <span class="lis_cp"></span>
            <span class="lis_ville"></span>
            <span class="lis_tuteur"></span>
            <span class="lis_mailtuteur"></span>
            <span class="lis_teltuteur"></span>
            <span class="lis_sujet"></span>
            <span class="lis_taches"></span>
            <?php if (isset($_SESSION['typecompte']) && $_SESSION['typecompte'] == 3): ?>
                <span class="actions">
                    <button class="btnSupprimer" style="padding: 5px 10px; cursor: pointer; background-color: #dc3545; color: white; border: none; border-radius: 4px;">
                        Supprimer
                    </button>
                </span>
            <?php endif; ?>
        </div>
    </template>
</div>

<?php
if (isset($_GET['success']) && $_GET['success'] === 'ajout') {
    echo '<script>
        window.addEventListener("DOMContentLoaded", () => {
            showNotification("Stage ajouté avec succès !", "success");
            window.history.replaceState({}, "", "/stages");
        });
    </script>';
}
if (isset($_GET['error'])) {
    echo '<script>
        window.addEventListener("DOMContentLoaded", () => {
            showNotification("Erreur : ' . addslashes(htmlspecialchars($_GET['error'])) . '", "error");
            window.history.replaceState({}, "", "/stages");
        });
    </script>';
}

try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->query("SELECT * FROM ONL_LISTESTAGE ORDER BY LIS_ID DESC");
    $stages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log($e->getMessage());
    echo "<p style='color: red;'>Erreur lors de la récupération des stages.</p>";
    $stages = [];
}
?>

<script>
function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    
    if (type === 'success') {
        notification.style.backgroundColor = '#d4edda';
        notification.style.color = '#155724';
        notification.style.border = '1px solid #c3e6cb';
    } else if (type === 'error') {
        notification.style.backgroundColor = '#f8d7da';
        notification.style.color = '#721c24';
        notification.style.border = '1px solid #f5c6cb';
    } else if (type === 'info') {
        notification.style.backgroundColor = '#d1ecf1';
        notification.style.color = '#0c5460';
        notification.style.border = '1px solid #bee5eb';
    }
    
    notification.style.display = 'block';
    
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            notification.style.display = 'none';
            notification.style.opacity = '1';
        }, 300);
    }, 4000);
}

function showConfirmModal(message, onConfirm) {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
    `;
    
    const modalContent = document.createElement('div');
    modalContent.style.cssText = `
        background: white;
        padding: 30px;
        border-radius: 12px;
        max-width: 400px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    `;
    
    modalContent.innerHTML = `
        <h3 style="margin-top: 0; color: #333;">Confirmation</h3>
        <p style="color: #666; margin: 20px 0;">${message}</p>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
            <button id="modalCancel" style="padding: 10px 20px; border: 1px solid #ddd; background: white; border-radius: 6px; cursor: pointer;">
                Annuler
            </button>
            <button id="modalConfirm" style="padding: 10px 20px; border: none; background: #dc3545; color: white; border-radius: 6px; cursor: pointer;">
                Supprimer
            </button>
        </div>
    `;
    
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
    
    document.getElementById('modalCancel').onclick = () => {
        document.body.removeChild(modal);
    };
    
    document.getElementById('modalConfirm').onclick = () => {
        document.body.removeChild(modal);
        onConfirm();
    };
    
    modal.onclick = (e) => {
        if (e.target === modal) {
            document.body.removeChild(modal);
        }
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('stagesContainer');
    const template = document.getElementById('stageTemplate');
    const btnAjouter = document.getElementById('btnAjouter');
    const formAjout = document.getElementById('formAjout');
    const btnAnnuler = document.getElementById('btnAnnuler');

    const stages = <?php echo json_encode($stages, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    const isAdmin = <?php echo isset($_SESSION['typecompte']) && $_SESSION['typecompte'] == 3 ? 'true' : 'false'; ?>;

    // La base renvoie AAAA-MM-JJ : on affiche JJ/MM/AAAA
    function formatDate(iso) {
        const parts = (iso || '').split('-');
        return parts.length === 3 ? `${parts[2]}/${parts[1]}/${parts[0]}` : (iso || '');
    }

    stages.forEach(stage => {
        const clone = template.content.cloneNode(true);
        const stageDiv = clone.querySelector('.stage-line');
        
        stageDiv.setAttribute('data-stage-id', stage.LIS_ID);
        clone.querySelector('.lis_datedebut').textContent = formatDate(stage.LIS_DATEDEBUT);
        clone.querySelector('.lis_datefin').textContent = formatDate(stage.LIS_DATEFIN);
        clone.querySelector('.lis_teletravail').textContent = stage.LIS_TELETRAVAIL == 1 ? 'Oui' : 'Non';
        clone.querySelector('.lis_entreprise').textContent = stage.LIS_ENTREPRISE || '';
        clone.querySelector('.lis_adresse').textContent = stage.LIS_ADRESSE || '';
        clone.querySelector('.lis_cp').textContent = stage.LIS_CP || '';
        clone.querySelector('.lis_ville').textContent = stage.LIS_VILLE || '';
        clone.querySelector('.lis_tuteur').textContent = stage.LIS_TUTEUR || '';
        clone.querySelector('.lis_mailtuteur').textContent = stage.LIS_MAILTUTEUR || '';
        clone.querySelector('.lis_teltuteur').textContent = stage.LIS_TELTUTEUR || '';
        clone.querySelector('.lis_sujet').textContent = stage.LIS_SUJET || '';
        clone.querySelector('.lis_taches').textContent = stage.LIS_TACHES || '';

        container.appendChild(clone);
    });

    if (btnAjouter) {
        btnAjouter.addEventListener('click', () => {
            formAjout.style.display = 'block';
            btnAjouter.style.display = 'none';
        });
    }

    if (btnAnnuler) {
        btnAnnuler.addEventListener('click', () => {
            formAjout.style.display = 'none';
            btnAjouter.style.display = 'block';
            document.getElementById('stageForm').reset();
        });
    }

    if (isAdmin) {
        container.addEventListener('click', (e) => {
            if (e.target.classList.contains('btnSupprimer')) {
                const stageDiv = e.target.closest('.stage-line');
                const stageId = stageDiv.getAttribute('data-stage-id');
                
                showConfirmModal('Êtes-vous sûr de vouloir supprimer ce stage ?', () => {
                    fetch('?url=stageController', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=supprimer&id=${stageId}&csrf_token=<?php echo $_SESSION['csrf_token']; ?>`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            stageDiv.remove();
                            showNotification('Stage supprimé avec succès', 'success');
                        } else {
                            showNotification('Erreur : ' + data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showNotification('Erreur lors de la suppression', 'error');
                        console.error('Erreur:', error);
                    });
                });
            }
        });
    }
});
</script>

<?php include_once(ROOT_DIR . 'app/views/includes/footer.php'); ?>
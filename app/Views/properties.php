<style>
        .property-card {
        border-radius: 14px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .property-card:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .property-card img {
        transition: transform 0.4s ease;
        height: 230px;
        object-fit: cover;
        width: 100%;
    }

    .property-card:hover img {
        transform: scale(1.05);
    }

    .property-content h5 {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .property-content p {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .see-details-btn {
        border-radius: 30px;
        font-size: 0.9rem;
    }

    .custom-pagination .pagination li a,
    .custom-pagination .pagination li span {
        padding: 6px 12px;
        margin: 0 2px;
        border-radius: 6px;
    }
    .cursor-pointer {
    cursor: pointer;
    }
    .search-results {
    max-height: 300px;
    overflow-y: auto;
    }
</style>

<div class="hero position-relative d-flex align-items-center justify-content-center text-white" style="
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.65)), 
                url('images/hero_bg_1.jpg') center/cover no-repeat;
    height: 220px;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    overflow: hidden;
">
    <div class="container text-center">
        <h1 class="fs-2 fw-semibold mb-2" data-aos="fade-up" style="color: white !important;">Explore All Properties</h1>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="150">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a href="/" class="text-white-50 text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">All Properties</li>
            </ol>
        </nav>
    </div>
</div>
<div class="section section-properties">
    <div class="container">
        <div id="propertyList" class="row">
            <form method="get" class="row g-2 mb-4" id="filterForm" action="<?= base_url('properties') ?>">
                <!-- Keyword -->
                 <div class="col-md-3">
                    <div class="position-relative">
                        <input type="text" 
                            class="form-control pe-5" 
                            placeholder="🔍 Try Godrej or Whitefield" 
                            id="searchInputTrigger"
                            onfocus="showSearchBox()" 
                            readonly
                            style="cursor: pointer;">
                        <!-- Optional search icon inside the input -->
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted">
                            <i class="bi bi-search"></i> <!-- requires Bootstrap Icons -->
                            </span>
                    </div>
                </div>
                <!-- Type -->
                <div class="col-md-2">
                    <button type="button" class="form-control text-center" onclick="showTypePopup()">Type</button>
                </div>
                <input type="hidden" name="type" id="typeInput">
                <input type="hidden" name="bhk" id="bhkInput">
                <input type="hidden" name="plot_area" id="plotAreaHidden">
                <!-- BHK -->
                <!-- <div class="col-md-1">
                    <select name="bhk" class="form-select">
                        <option value="">BHK</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>" <?= ($filters['bhk'] ?? '') == $i ? 'selected' : '' ?>><?= $i ?> BHK</option>
                        <?php endfor; ?>
                    </select>
                </div> -->
                <div class="col-md-2">
                    <button type="button" class="form-control w-100" data-bs-toggle="modal" data-bs-target="#budgetModal">
                        Budget
                    </button>
                </div>
                <input type="hidden" name="min_budget" id="minBudgetHidden">
                <input type="hidden" name="max_budget" id="maxBudgetHidden"> 
                <div class="col-md-2">
                    <button type="button" class="form-control" data-bs-toggle="modal" data-bs-target="#sortByModal">Sort By</button>
                </div>          
                <!-- <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div> -->
            </form>
            <!-- Bootstrap Modal Search -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Search Properties</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search location, project, builder..." oninput="liveSearch(this.value)">
                        <div class="search-results" id="searchResults">
                        <small class="text-muted">Enter at least 3 characters...</small>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Type Selection Modal -->
           <div class="modal fade" id="typeModal" tabindex="-1" aria-labelledby="typeModalLabel">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="typeModalLabel">Select Property Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Type Options -->
                            <div class="btn-group w-100 mb-3">
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectType('Apartment')">Apartment</button>
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectType('Villa')">Villa</button>
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectType('Plot')">Plot</button>
                            </div>

                            <!-- BHK Options -->
                            <div id="bhkOptions" class="d-none">
                            <label class="form-label">Select BHK</label>
                            <select class="form-select" id="bhkSelect"></select>
                            </div>

                            <!-- Plot Area -->
                            <div id="plotArea" class="d-none">
                            <label class="form-label">Minimum Plot Area (sqft)</label>
                            <input type="number" class="form-control" id="plotAreaInput" placeholder="e.g., 1200">
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="applyTypeSelection()">Apply</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="sortByModal" tabindex="-1" aria-labelledby="sortByModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form method="get" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sortByModalLabel">Sort Properties</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <select name="sort_by" class="form-select">
                        <option value="">-- Select Sort Option --</option>
                        <!-- <option value="popularity" <?= ($filters['sort_by'] ?? '') == 'popularity' ? 'selected' : '' ?>>Popularity - High to Low</option> -->
                        <option value="possession_new" <?= ($filters['sort_by'] ?? '') == 'possession_new' ? 'selected' : '' ?>>Possession Date - New to Old</option>
                        <option value="possession_old" <?= ($filters['sort_by'] ?? '') == 'possession_old' ? 'selected' : '' ?>>Possession Date - Old to New</option>
                        <option value="price_high" <?= ($filters['sort_by'] ?? '') == 'price_high' ? 'selected' : '' ?>>Price - High to Low</option>
                        <option value="price_low" <?= ($filters['sort_by'] ?? '') == 'price_low' ? 'selected' : '' ?>>Price - Low to High</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php foreach ($properties as $property): ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <a href="<?= base_url('property_details/' . $property['id']) ?>" class="card-link text-decoration-none">
                            <div class="card shadow-sm border-0 h-100" style="border-radius: 14px; overflow: hidden;">
                                
                                <!-- Property Image with Overlay -->
                                <div style="position: relative;">
                                    <img src="<?= base_url('uploads/properties/' . ($property['image'] ?? 'default.jpg')) ?>"
                                        alt="<?= esc($property['name']) ?>"
                                        style="width: 100%; height: 230px; object-fit: cover;">

                                    <!-- Name and Price Overlay -->
                                    <div style="
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        padding: 10px 14px;
                                        background: rgba(0, 0, 0, 0.55);
                                        color: #fff;
                                        font-size: 13px;
                                    ">
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <strong><?= esc($property['name']) ?></strong>
                                            <span>
                                                ₹<?= number_format($property['start_price']) ?> Cr -
                                                ₹<?= number_format($property['end_price']) ?> Cr
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Property Details -->
                                <div class="card-body px-3 pt-2 pb-3" style="font-size: 14px;">
                                    <!-- Location & Possession -->
                                    <div class="d-flex justify-content-between flex-wrap mb-1 text-muted">
                                        <span class="mb-1">
                                            <i class="bi bi-geo-alt-fill me-1"></i><?= esc($property['location']) ?>
                                        </span>
                                        <span>
                                            <i class="bi bi-calendar-event me-1"></i><?= esc($property['possession_date']) ?>
                                        </span>
                                    </div>

                                    <!-- Type & Size -->
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <span>
                                            <i class="bi bi-building me-1"></i><?= esc($property['property_type']) ?>
                                        </span>
                                        <span>
                                            <i class="bi bi-aspect-ratio me-1"></i>
                                            <?= esc($property['property_type_detail']) ?>
                                            <?php if (strtolower($property['property_type']) === 'plot'): ?>
                                                sqft
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Pagination & Info -->
            <div class="row align-items-center py-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <p class="mb-0">
                        <strong>Showing page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?></strong>
                    </p>
                </div>
                <div class="col-md-8 text-md-end text-center">
                    <div class="custom-pagination d-inline-block">
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>

            <!-- Budget Filter Modal -->
            <div class="modal fade" id="budgetModal" tabindex="-1" aria-labelledby="budgetModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="budgetModalLabel">Select Budget</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                        <label for="minBudgetSelect" class="form-label">Min Budget</label>
                        <select id="minBudgetSelect" name="min_budget" class="form-select">
                            <option value="">Min Budget</option>
                            <?php foreach ($minBudgets as $val): ?>
                                <?php
                                    $display = $val >= 10000000
                                        ? rtrim(rtrim(number_format($val / 10000000, 2), '0'), '.') . ' Cr'
                                        : rtrim(rtrim(number_format($val / 100000, 2), '0'), '.') . ' L';
                                ?>
                                <option value="<?= $val ?>" <?= ($filters['min_budget'] ?? '') == $val ? 'selected' : '' ?>>
                                    <?= $display ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        </div>

                        <div class="mb-3">
                        <label for="maxBudgetSelect" class="form-label">Max Budget</label>
                       <select id="maxBudgetSelect" name="max_budget" class="form-select">
                            <option value="">Max Budget</option>
                            <?php foreach ($maxBudgets as $val): ?>
                                <?php
                                    $display = $val >= 10000000
                                        ? rtrim(rtrim(number_format($val / 10000000, 2), '0'), '.') . ' Cr'
                                        : rtrim(rtrim(number_format($val / 100000, 2), '0'), '.') . ' L';
                                ?>
                                <option value="<?= $val ?>" <?= ($filters['max_budget'] ?? '') == $val ? 'selected' : '' ?>>
                                    <?= $display ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="submitFilterForm()">Apply</button>
                    </div>
                    </div>
                </div>
            </div>
    

            <!-- Pagination -->

    </div>
</div>
<script>
function submitFilterForm() {
    // Copy selected values from modal to hidden inputs
    document.getElementById('minBudgetHidden').value = document.getElementById('minBudgetSelect').value;
    document.getElementById('maxBudgetHidden').value = document.getElementById('maxBudgetSelect').value;

    // Submit form
    document.getElementById('filterForm').submit();
}

</script>

<script>
function showSearchBox() {
  const modal = new bootstrap.Modal(document.getElementById('searchModal'));
  modal.show();
}

function liveSearch(value) {
  const results = document.getElementById('searchResults');
  results.innerHTML = '';

  if (value.length < 3) {
    results.innerHTML = '<small class="text-muted">Enter at least 3 characters...</small>';
    return;
  }

  fetch(`/property/search?q=${encodeURIComponent(value)}`)
    .then(res => res.json())
    .then(data => {
      if (!Array.isArray(data)) {
        results.innerHTML = '<small class="text-danger">Unexpected response.</small>';
        return;
      }

      if (data.length === 0) {
        results.innerHTML = '<small class="text-muted">No matches found.</small>';
      } else {
        results.innerHTML = data.map(item => `
          <div class="py-2 border-bottom text-primary cursor-pointer" onclick="selectSuggestion('${item.name}', ${item.id})">
            <strong>${item.name}</strong> <small class="text-muted">(${item.location})</small>
          </div>
        `).join('');
      }
    })
    .catch(() => {
      results.innerHTML = '<small class="text-danger">Error fetching data.</small>';
    });
}

function selectSuggestion(name, id) {
  bootstrap.Modal.getInstance(document.getElementById('searchModal')).hide();
  window.location.href = `/property_details/${id}`;
}
</script>
<script>
let selectedType = '';
let selectedBHK = '';
let selectedPlotArea = '';

function showTypePopup() {
    const modal = new bootstrap.Modal(document.getElementById('typeModal'));
    modal.show();
}

function selectType(type) {
    selectedType = type;

    // Reset styles
    document.querySelectorAll('#typeModal .btn-group .btn').forEach(btn => {
        btn.classList.remove('active');
    });

    // Highlight selected
    const allButtons = document.querySelectorAll('#typeModal .btn-group .btn');
    allButtons.forEach(btn => {
        if (btn.textContent.trim() === type) {
            btn.classList.add('active');
        }
    });

    // Hide all fields
    document.getElementById('bhkOptions').classList.add('d-none');
    document.getElementById('plotArea').classList.add('d-none');

    // Show relevant input
    if (type === 'Apartment') {
        populateBHK(['1 BHK', '1.5 BHK', '2 BHK', '2.5 BHK', '3 BHK', '3.5 BHK', '4 BHK', '4.5 BHK', '5 BHK']);
    } else if (type === 'Villa') {
        populateBHK(['3 BHK', '3.5 BHK', '4 BHK', '4.5 BHK', '5 BHK']);
    } else if (type === 'Plot') {
        document.getElementById('plotArea').classList.remove('d-none');
    }
}


function populateBHK(options) {
    const bhkSelect = document.getElementById('bhkSelect');
    bhkSelect.innerHTML = '';

    // Add an empty default option
    const emptyOption = document.createElement('option');
    emptyOption.value = '';
    emptyOption.textContent = '-- Select BHK --';
    bhkSelect.appendChild(emptyOption);

    // Add actual BHK options
    options.forEach(opt => {
        const option = document.createElement('option');
        option.value = opt;
        option.textContent = opt;
        bhkSelect.appendChild(option);
    });

    // Show the BHK dropdown section
    document.getElementById('bhkOptions').classList.remove('d-none');
}


function applyTypeSelection() {
    // Get selected values
    const bhkSelect = document.getElementById('bhkSelect');
    selectedBHK = bhkSelect && !bhkSelect.classList.contains('d-none') ? bhkSelect.value : '';
    selectedPlotArea = document.getElementById('plotAreaInput').value || '';

    // Assign to hidden inputs
    document.getElementById('typeInput').value = selectedType;
    document.getElementById('bhkInput').value = selectedBHK;
    document.getElementById('plotAreaHidden').value = selectedPlotArea;

    // Button label update
    const triggerBtn = document.querySelector('.col-md-2 button');
    let summary = selectedType;
    if ((selectedType === 'Apartment' || selectedType === 'Villa') && selectedBHK) {
        summary += ' - ' + selectedBHK;
    } else if (selectedType === 'Plot' && selectedPlotArea) {
        summary += ' - ' + selectedPlotArea;
    }
    triggerBtn.textContent = summary;

    // Close modal
    const modalInstance = bootstrap.Modal.getInstance(document.getElementById('typeModal'));
    if (modalInstance) modalInstance.hide();

    // Submit after modal closes
    setTimeout(() => {
        document.getElementById('filterForm').submit();
    }, 300);
}
</script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const targetRow = document.getElementById('propertyList'); // or your actual section ID
        if (targetRow) {
            targetRow.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>

<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ConnectivityPointModel;
use App\Models\LegalApprovalModel;
use App\Models\MasterPlanModel;
use App\Models\PropertyImageModel;
use App\Models\PropertyModel;
use App\Models\FloorPlanModel;
use App\Models\FloorPlanImageModel;
use App\Models\PropertyAmenitiesModel;
use App\Models\PropertySpecificationsModel;
use App\Models\MicroMarketDocumentModel;
use App\Models\MicroMarketSectionModel;
use App\Models\DeveloperModel;
use CodeIgniter\Controller;

class AdminController extends BaseController
{
    protected $propertyModel;
    protected $propertyImageModel;
    protected $adminModel;
    protected $connectivityPointModel;
    protected $masterPlanModel;
    protected $floorPlanModel;
    protected $floorPlanImageModel;
    protected $propertyAmenitiesModel;
    protected $propertySpecificationsModel;
    protected $legalApprovalModel;
    protected $microMarketDocumentModel;
    protected $microMarketSectionModel;
    protected $developerModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
        $this->propertyImageModel = new PropertyImageModel();
        $this->adminModel = new AdminModel();
        $this->connectivityPointModel = new ConnectivityPointModel();
        $this->masterPlanModel = new MasterPlanModel();
        $this->floorPlanModel = new FloorPlanModel();
        $this->floorPlanImageModel = new FloorPlanImageModel();
        $this->propertyAmenitiesModel = new PropertyAmenitiesModel();
        $this->propertySpecificationsModel = new PropertySpecificationsModel();
        $this->legalApprovalModel = new LegalApprovalModel();
        $this->microMarketDocumentModel = new MicroMarketDocumentModel();
        $this->microMarketSectionModel = new MicroMarketSectionModel();
        $this->developerModel = new DeveloperModel();

    }

    public function index(): string
    {
        return view('admin/index');
    }

    public function login()
    {
        $session = session();

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->adminModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set('isAdminLoggedIn', true);
            $session->set('adminUser', $user);
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin')->with('success', 'You have been logged out successfully.');
    }

    public function dashboard()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id'); // assuming session stores admin_id
        $user = $this->adminModel->find($adminId);

        $data = [
            'title' => 'Dashboard',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/dashboard',
        ];

        return view('admin/layout/templates', $data);
    }


    public function properties()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $adminId = session()->get('admin_id'); // assuming session stores admin_id
        $user = $this->adminModel->find($adminId);

        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;

        $properties = $this->propertyModel->orderBy('id', 'DESC')->paginate($perPage, 'group1');
        $pager = $this->propertyModel->pager;

        $data = [
            'title' => 'Properties',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/properties',
            'properties' => $properties,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
        ];

        return view('admin/layout/templates', $data);
    }

    public function add_property()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id'); // assuming session stores admin_id
        $user = $this->adminModel->find($adminId);

        $data = [
            'title' => 'Properties',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/add_property',
        ];

        return view('admin/layout/templates', $data);
    }
    public function save_property()
    {
        helper(['form', 'url']);

        // Determine property type detail value
        $propertyType = $this->request->getPost('property_type');
        $propertyTypeDetail = '';

        if ($propertyType === 'apartment') {
            $propertyTypeDetail = implode(',', $this->request->getPost('apartment_type') ?? []);
        } elseif ($propertyType === 'villa') {
            $propertyTypeDetail = implode(',', $this->request->getPost('villa_type') ?? []);
        } elseif ($propertyType === 'plot') {
            $propertyTypeDetail = implode(',', $this->request->getPost('plot_type') ?? []);
        }

        // Prepare property data
        $propertyData = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'start_price' => $this->request->getPost('start_price'),
            'end_price' => $this->request->getPost('end_price'),
            'property_type' => $propertyType,
            'property_type_detail' => $propertyTypeDetail,
            'possession_date' => $this->request->getPost('possession_date'),
            'land_area' => $this->request->getPost('land_area'),
            'avg_land_area' => $this->request->getPost('avg_land_area'),
            'clubhouse_area' => $this->request->getPost('clubhouse_area'),
            'avg_clubhouse_area' => $this->request->getPost('avg_clubhouse_sqft'),
            'park_area' => $this->request->getPost('park_area'),
            'avg_park_area' => $this->request->getPost('avg_park_area'),
            'open_area' => $this->request->getPost('open_area'),
            'avg_open_area' => $this->request->getPost('avg_open_area'),
            'units' => $this->request->getPost('units'),
            'avg_units' => $this->request->getPost('avg_units'),
            'price_per_sqft' => $this->request->getPost('price_per_sqft'),
            'avg_price_per_sqft' => $this->request->getPost('avg_price_per_sqft'),
            'clubhouse_factor' => $this->request->getPost('clubhouse_factor'),
            'avg_clubhouse_factor' => $this->request->getPost('avg_clubhouse_factor'),
            'metro_distance' => $this->request->getPost('metro_distance'),
            'avg_metro_distance' => $this->request->getPost('avg_metro_distance'),
            'road_width' => $this->request->getPost('road_width'),
            'avg_road_width' => $this->request->getPost('avg_road_width'),
            'unit_density' => $this->request->getPost('unit_density'),
            'avg_unit_density' => $this->request->getPost('avg_unit_density'),
        ];
        // print_r($propertyData);
        // die();
        // Insert property and get inserted ID
        $this->propertyModel->insert($propertyData);
        $propertyId = $this->propertyModel->getInsertID();

        // Handle property images upload
        $imageFiles = $this->request->getFiles()['property_images'] ?? [];
        $uploadPath = FCPATH . 'uploads/properties/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if (is_array($imageFiles)) {
            foreach ($imageFiles as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $imageName = $file->getRandomName();
                    $file->move($uploadPath, $imageName);

                    $this->propertyImageModel->insert([
                        'property_id' => $propertyId,
                        'image' => $imageName,
                    ]);
                }
            }
        }

        // Handle multiple master plan image uploads
        $masterPlanImages = $this->request->getFileMultiple('master_plan_image');
        $masterPlanUploadPath = FCPATH . 'uploads/master_plans/';

        if (!is_dir($masterPlanUploadPath)) {
            mkdir($masterPlanUploadPath, 0755, true);
        }

        foreach ($masterPlanImages as $image) {
            if ($image->isValid() && !$image->hasMoved()) {
                $masterPlanImageName = $image->getRandomName(); // Example: 'random123.jpg'
                $image->move($masterPlanUploadPath, $masterPlanImageName);

                $this->masterPlanModel->insert([
                    'property_id' => $propertyId,
                    'master_plan_image' => $masterPlanImageName, // Ensure this is a string like 'xyz.jpg'
                ]);
            }
        }
        // Floor Plans
        $floorPlans = $this->request->getPost('floor_plans');
        if (!is_array($floorPlans)) {
            log_message('error', 'Invalid floorPlans data');
            $floorPlans = [];
        }

        $floorPlanFiles = $this->request->getFiles()['floor_plans'] ?? [];

        $floorPlanPath = FCPATH . 'uploads/floor_plans/';
        if (!is_dir($floorPlanPath)) {
            mkdir($floorPlanPath, 0755, true);
        }

        foreach ($floorPlans as $index => $floorPlan) {
            // Save floor plan details first
            $floorPlanData = [
                'property_id' => $propertyId,
                'bhk_type' => $floorPlan['bhk'] ?? '',
                'price' => $floorPlan['price'] ?? '',
                'saleable_area' => $floorPlan['saleable_area'] ?? '',
                'entrance_direction' => $floorPlan['entrance_direction'] ?? '',
                'carpet_area' => $floorPlan['carpet_area'] ?? '',
                'efficiency' => $floorPlan['efficiency'] ?? '',
                'floor_height' => $floorPlan['floor_height'] ?? '',
                'bathroom_count' => $floorPlan['bathroom_count'] ?? 0,
                'balcony_count' => $floorPlan['balcony_count'] ?? 0,
            ];

            $this->floorPlanModel->insert($floorPlanData);
            $floorPlanId = $this->floorPlanModel->getInsertID();

            // Upload images for this floor plan
            $images = $floorPlanFiles[$index]['images'] ?? [];

            if (!empty($images) && is_array($images)) {
                foreach ($images as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $imgName = $img->getRandomName();
                        $img->move($floorPlanPath, $imgName);

                        // Save to floor_plan_images table (optional model)
                        $this->floorPlanImageModel->insert([
                            'floor_plan_id' => $floorPlanId,
                            'image' => $imgName
                        ]);
                    }
                }
            }
        }
        // Amenities
        $amenities = ['lifestyle' => [], 'sports' => [], 'natural' => []];
        foreach ($amenities as $type => &$items) {
            $selected = $this->request->getPost("{$type}_amenities") ?? [];
            foreach ($selected as $item) {
                $isRare = $this->request->getPost("{$type}_rare")[$item] ?? null;
                $items[] = [
                    'name' => $item,
                    'tag' => $isRare === 'RARE' ? 'RARE' : 'NORMAL',
                ];
            }
        }

        $this->propertyAmenitiesModel->insert([
            'property_id' => $propertyId,
            'amenities_json' => json_encode($amenities),
        ]);


        // Specifications
        $specifications = [
            'flooring' => $this->request->getPost('specifications')['flooring'] ?? [],
            'doors' => $this->request->getPost('specifications')['doors'] ?? [],
            'paint' => $this->request->getPost('specifications')['paint'] ?? [],
            'others' => $this->request->getPost('specifications')['others'] ?? [],
        ];

        $this->propertySpecificationsModel->insert([
            'property_id' => $propertyId,
            'specifications_json' => json_encode($specifications),
        ]);
        // Handle Legal Approvals
        $legalApprovals = $this->request->getPost('legal_approvals') ?? [];
        $legalFiles = $this->request->getFiles()['legal_approvals'] ?? [];
        $uploadDir = FCPATH . 'documents/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!empty($legalApprovals) && is_array($legalApprovals)) {
            foreach ($legalApprovals as $index => $approval) {
                $title = $approval['title'] ?? '';
                $approvedBy = $approval['approved_by'] ?? '';
                $status = $approval['status'] ?? '';

                // Handle file
                $fileName = null;
                if (!empty($legalFiles[$index]['document_file']) && $legalFiles[$index]['document_file']->isValid()) {
                    $file = $legalFiles[$index]['document_file'];
                    $fileName = $file->getRandomName();
                    $file->move($uploadDir, $fileName);
                }

                // Save to DB
                $this->legalApprovalModel->insert([
                    'property_id' => $propertyId,
                    'title' => $title,
                    'approved_by' => $approvedBy,
                    'status' => $status,
                    'document_file' => $fileName,
                ]);
            }
        }
        // //Handle micro market
        // $documents = $this->request->getPost('documents') ?? [];
        // $files = $this->request->getFiles()['documents'] ?? [];

        // $documentModel = new MicroMarketDocumentModel();
        // $sectionModel = new MicroMarketSectionModel();

        // $uploadDir = FCPATH . 'documents/';
        // if (!is_dir($uploadDir)) {
        //     mkdir($uploadDir, 0755, true);
        // }

        // // Save document cards
        // if (!empty($documents)) {
        //     foreach ($documents as $index => $doc) {
        //         $title = $doc['title'] ?? '';
        //         $description = $doc['description'] ?? '';
        //         $linkText = $doc['link_text'] ?? '';
        //         $linkUrl = $doc['link_url'] ?? '';
        //         $iconFile = $files[$index]['image'] ?? null;

        //         $iconFileName = null;
        //         if ($iconFile && $iconFile->isValid()) {
        //             $iconFileName = $iconFile->getRandomName();
        //             $iconFile->move($uploadDir, $iconFileName);
        //         }

        //         // Insert into table
        //         $documentModel->insert([
        //             'property_id' => $propertyId,
        //             'title' => $title,
        //             'description' => $description,
        //             'link_text' => $linkText,
        //             'link_url' => $linkUrl,
        //             'image' => $iconFileName,
        //         ]);
        //     }
        // }

        // // Save section data
        // $sectionImage = $this->request->getFile('section_image');
        // $sectionTitle = $this->request->getPost('section_title');
        // $sectionDescription = $this->request->getPost('section_description');
        // $sectionDirr = FCPATH . 'images/';
        // $sectionImageName = null;
        // if ($sectionImage && $sectionImage->isValid()) {
        //     $sectionImageName = $sectionImage->getRandomName();
        //     $sectionImage->move($sectionDirr, $sectionImageName);
        // }

        // $sectionModel->insert([
        //     'property_id' => $propertyId,
        //     'section_title' => $sectionTitle,
        //     'section_description' => $sectionDescription,
        //     'section_image' => $sectionImageName,
        // ]);
        return redirect()->to('/admin/properties')->with('success', 'Property saved successfully.');
    }
    public function delete_master_plan($id)
    {
        // Your logic to delete image
        $deleted = $this->masterPlanModel->delete($id);

        if ($deleted) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Master plan image deleted successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete master plan image.'
            ])->setStatusCode(500);
        }
    }






    public function edit_property($id)
    {
        $property = $this->propertyModel->find($id);
        if (!$property) {
            return redirect()->to('/admin/properties')->with('error', 'Property not found.');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        // Fetch related images
        $images = $this->propertyImageModel->where('property_id', $id)->findAll();
        $masterPlans = $this->masterPlanModel->where('property_id', $id)->findAll();

        // Fetch all floor plans
        $floorPlans = $this->floorPlanModel->where('property_id', $id)->findAll();

        // Fetch images for each floor plan
        foreach ($floorPlans as &$floorPlan) {
            $floorPlan['images'] = $this->floorPlanImageModel
                ->where('floor_plan_id', $floorPlan['id'])
                ->findAll();
        }
        // Fetch Amenities (decode JSON and prepare grouped format)
        $grouped_amenities = ['lifestyle' => [], 'sports' => [], 'natural' => []];
        $amenityRow = $this->propertyAmenitiesModel->where('property_id', $id)->first();

        if ($amenityRow && $amenityRow['amenities_json']) {
            $decoded = json_decode($amenityRow['amenities_json'], true);
            foreach ($decoded as $category => $items) {
                foreach ($items as $item) {
                    $grouped_amenities[$category][] = [
                        'name' => $item['name'],
                        'selected' => true,
                        'rare' => $item['tag'] ?? 'NORMAL',
                    ];
                }
            }
        }

        // Fetch Specifications
        $specifications = ['flooring' => [], 'doors' => [], 'paint' => [], 'others' => []];
        $specRow = $this->propertySpecificationsModel->where('property_id', $id)->first();

        if ($specRow && $specRow['specifications_json']) {
            $specifications = json_decode($specRow['specifications_json'], true);
        }

        // Fetch Legal Approvals
        $legalApprovals = $this->legalApprovalModel->where('property_id', $id)->findAll();
        // Fetch Legal Approvals
        $legalApprovals = $this->legalApprovalModel
            ->where('property_id', $id)
            ->findAll();

        $microMarketDocuments = $this->microMarketDocumentModel
            ->where('property_id', $id)
            ->orderBy('id', 'asc')
            ->findAll();

        $microMarketSection = $this->microMarketSectionModel
            ->where('property_id', $id)
            ->first();

        $data = [
            'title' => 'Properties',
            'name' => $user['username'] ?? 'Admin',
            'property' => $property,
            'propertyImages' => $images,
            'masterPlans' => $masterPlans,
            'floorPlans' => $floorPlans,
            'grouped_amenities' => $grouped_amenities,
            'specifications' => $specifications,
            'legalApprovals' => $legalApprovals,
            'microMarketDocuments' => $microMarketDocuments,
            'microMarketSection' => $microMarketSection,
            'content' => 'admin/edit_property',
        ];

        return view('admin/layout/templates', $data);
    }



    public function update_property($id)
    {
        helper(['form', 'url']);

        $property = $this->propertyModel->find($id);
        if (!$property) {
            return redirect()->to('/admin/properties')->with('error', 'Property not found.');
        }

        // Handle property_type_detail
        $propertyType = $this->request->getPost('property_type');
        $propertyTypeDetail = null;

        if ($propertyType === 'apartment') {
            $propertyTypeDetail = implode(',', $this->request->getPost('apartment_type') ?? []);
        } elseif ($propertyType === 'villa') {
            $propertyTypeDetail = implode(',', $this->request->getPost('villa_type') ?? []);
        } elseif ($propertyType === 'plot') {
            $propertyTypeDetail = implode(',', $this->request->getPost('plot_type') ?? []);
        }

        // Property main data
        $propertyData = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'start_price' => $this->request->getPost('start_price'),
            'end_price' => $this->request->getPost('end_price'),
            'property_type' => $propertyType,
            'property_type_detail' => $propertyTypeDetail,
            'possession_date' => $this->request->getPost('possession_date'),

            // Review fields
            'land_area' => $this->request->getPost('land_area'),
            'avg_land_area' => $this->request->getPost('avg_land_area'),
            'clubhouse_area' => $this->request->getPost('clubhouse_area'),
            'avg_clubhouse_area' => $this->request->getPost('avg_clubhouse_sqft'),
            'park_area' => $this->request->getPost('park_area'),
            'avg_park_area' => $this->request->getPost('avg_park_area'),
            'open_area' => $this->request->getPost('open_area'),
            'avg_open_area' => $this->request->getPost('avg_open_area'),
            'units' => $this->request->getPost('units'),
            'avg_units' => $this->request->getPost('avg_units'),
            'price_per_sqft' => $this->request->getPost('price_per_sqft'),
            'avg_price_per_sqft' => $this->request->getPost('avg_price_per_sqft'),
            'clubhouse_factor' => $this->request->getPost('clubhouse_factor'),
            'avg_clubhouse_factor' => $this->request->getPost('avg_clubhouse_factor'),
            'metro_distance' => $this->request->getPost('metro_distance'),
            'avg_metro_distance' => $this->request->getPost('avg_metro_distance'),
            'road_width' => $this->request->getPost('road_width'),
            'avg_road_width' => $this->request->getPost('avg_road_width'),
            'unit_density' => $this->request->getPost('unit_density'),
            'avg_unit_density' => $this->request->getPost('avg_unit_density'),
        ];

        // Update property
        $this->propertyModel->update($id, $propertyData);

        /**
         * Property Images Upload
         */
        $imageFiles = $this->request->getFiles()['images'] ?? [];
        $uploadPath = FCPATH . 'uploads/properties/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        foreach ($imageFiles as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move($uploadPath, $imageName);
                $this->propertyImageModel->insert([
                    'property_id' => $id,
                    'image' => $imageName,
                ]);
            }
        }

        /**
         * Master Plan Upload
         */
        $masterPlanImages = $this->request->getFiles()['master_plan_image'] ?? [];
        $masterPlanPath = FCPATH . 'uploads/master_plans/';
        if (!is_dir($masterPlanPath)) {
            mkdir($masterPlanPath, 0755, true);
        }

        foreach ($masterPlanImages as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move($masterPlanPath, $fileName);
                $this->masterPlanModel->insert([
                    'property_id' => $id,
                    'master_plan_image' => $fileName,
                ]);
            }
        }

        /**
         * Floor Plans Handling
         */
        $floorPlans = $this->request->getPost('floor_plans') ?? [];
        $floorPlanFiles = $this->request->getFiles()['floor_plans'] ?? [];
        $floorPlanPath = FCPATH . 'uploads/floor_plans/';
        if (!is_dir($floorPlanPath)) {
            mkdir($floorPlanPath, 0755, true);
        }

        foreach ($floorPlans as $index => $floorPlan) {
            $floorPlanId = $floorPlan['id'] ?? null;

            $floorPlanData = [
                'property_id' => $id,
                'bhk_type' => $floorPlan['bhk'] ?? '',
                'price' => $floorPlan['price'] ?? '',
                'saleable_area' => $floorPlan['saleable_area'] ?? '',
                'entrance_direction' => $floorPlan['entrance_direction'] ?? '',
                'carpet_area' => $floorPlan['carpet_area'] ?? '',
                'efficiency' => $floorPlan['efficiency'] ?? '',
                'floor_height' => $floorPlan['floor_height'] ?? '',
                'bathroom_count' => $floorPlan['bathroom_count'] ?? 0,
                'balcony_count' => $floorPlan['balcony_count'] ?? 0,
            ];

            if ($floorPlanId) {
                // Update existing floor plan
                $this->floorPlanModel->update($floorPlanId, $floorPlanData);
            } else {
                // Insert new floor plan
                $this->floorPlanModel->insert($floorPlanData);
                $floorPlanId = $this->floorPlanModel->getInsertID();
            }

            // Handle Floor Plan Images
            $images = $floorPlanFiles[$index]['images'] ?? [];
            if (!empty($images) && is_array($images)) {
                foreach ($images as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $imgName = $img->getRandomName();
                        $img->move($floorPlanPath, $imgName);
                        $this->floorPlanImageModel->insert([
                            'floor_plan_id' => $floorPlanId,
                            'image' => $imgName
                        ]);
                    }
                }
            }
        }
        // === Amenities Update ===
        $amenities = ['lifestyle' => [], 'sports' => [], 'natural' => []];
        foreach ($amenities as $type => &$items) {
            $selected = $this->request->getPost("{$type}_amenities") ?? [];
            foreach ($selected as $item) {
                $isRare = $this->request->getPost("{$type}_rare")[$item] ?? null;
                $items[] = [
                    'name' => $item,
                    'tag' => $isRare === 'RARE' ? 'RARE' : 'NORMAL',
                ];
            }
        }


        // Check if amenity exists for property_id
        $existingAmenity = $this->propertyAmenitiesModel
            ->where('property_id', $id)
            ->first();

        if ($existingAmenity) {
            $this->propertyAmenitiesModel->update($existingAmenity['id'], [
                'amenities_json' => json_encode($amenities),
            ]);
        } else {
            $this->propertyAmenitiesModel->insert([
                'property_id' => $id,
                'amenities_json' => json_encode($amenities),
            ]);
        }


        // === Specifications Update ===
        $specifications = [
            'flooring' => $this->request->getPost('specifications')['flooring'] ?? [],
            'doors' => $this->request->getPost('specifications')['doors'] ?? [],
            'paint' => $this->request->getPost('specifications')['paint'] ?? [],
            'others' => $this->request->getPost('specifications')['others'] ?? [],
        ];

        $existingSpec = $this->propertySpecificationsModel
            ->where('property_id', $id)
            ->first();

        if ($existingSpec) {
            $this->propertySpecificationsModel->update($existingSpec['id'], [
                'specifications_json' => json_encode($specifications),
            ]);
        } else {
            $this->propertySpecificationsModel->insert([
                'property_id' => $id,
                'specifications_json' => json_encode($specifications),
            ]);
        }
        $legalApprovals = $this->request->getPost('legal_approvals') ?? [];
        $legalFiles = $this->request->getFiles()['legal_approvals'] ?? [];
        $uploadDir = FCPATH . 'documents/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        foreach ($legalApprovals as $index => $approval) {
            $legalId = $approval['id'] ?? null;  // This is the primary key (legal_approvals.id)
            $title = $approval['title'] ?? '';
            $approvedBy = $approval['approved_by'] ?? '';
            $status = $approval['status'] ?? '';

            $fileName = null;
            if (!empty($legalFiles[$index]['document_file']) && $legalFiles[$index]['document_file']->isValid()) {
                $file = $legalFiles[$index]['document_file'];
                $fileName = $file->getRandomName();
                $file->move($uploadDir, $fileName);
            }

            $dataToSave = [
                'title' => $title,
                'approved_by' => $approvedBy,
                'status' => $status,
            ];

            if ($fileName) {
                $dataToSave['document_file'] = $fileName;
            }

            if ($legalId) {
                // UPDATE using legal ID (primary key)
                $this->legalApprovalModel->update($legalId, $dataToSave);
            } else {
                // INSERT new entry and add property_id
                $dataToSave['property_id'] = $id; // Make sure $propertyId is set in this method
                $this->legalApprovalModel->insert($dataToSave);
            }
        }
        // $documents = $this->request->getPost('documents');
        // $files = $this->request->getFiles()['documents'] ?? [];

        // $existingDocs = $this->microMarketDocumentModel
        //     ->where('property_id', $id)
        //     ->orderBy('id', 'asc')
        //     ->findAll();

        // foreach ($documents as $index => $doc) {
        //     if (!isset($existingDocs[$index]))
        //         continue;

        //     $docId = $existingDocs[$index]['id'];

        //     $imageFile = $files[$index]['image'] ?? null;
        //     $imageName = $existingDocs[$index]['image']; // default to existing image

        //     if ($imageFile && $imageFile->isValid()) {
        //         $imageName = $imageFile->getRandomName();
        //         $imageFile->move(FCPATH . 'documents/', $imageName);
        //     }

        //     $this->microMarketDocumentModel->update($docId, [
        //         'title' => $doc['title'] ?? '',
        //         'description' => $doc['description'] ?? '',
        //         'link_text' => $doc['link_text'] ?? '',
        //         'link_url' => $doc['link_url'] ?? '',
        //         'image' => $imageName,
        //     ]);
        // }
        // $sectionImage = $this->request->getFile('section_image');
        // $sectionTitle = $this->request->getPost('section_title');
        // $sectionDescription = $this->request->getPost('section_description');

        // $existingSection = $this->microMarketSectionModel
        //     ->where('property_id', $id)
        //     ->first();

        // $imageName = $existingSection['section_image'] ?? null;

        // if ($sectionImage && $sectionImage->isValid()) {
        //     $imageName = $sectionImage->getRandomName();
        //     $sectionImage->move(FCPATH . 'images/', $imageName);
        // }

        // $sectionData = [
        //     'section_title' => $sectionTitle,
        //     'section_description' => $sectionDescription,
        //     'section_image' => $imageName,
        // ];

        // $this->microMarketSectionModel->update($existingSection['id'], $sectionData);


        return redirect()->to('/admin/properties')->with('success', 'Property updated successfully.');
    }




    public function delete_property_image($imageId)
    {
        $image = $this->propertyImageModel->find($imageId);

        if ($image) {
            $imagePath = FCPATH . 'admin-template/uploads/properties/' . $image['image'];
            if (is_file($imagePath))
                unlink($imagePath);

            $this->propertyImageModel->delete($imageId);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Image deleted successfully.',
            'csrfHash' => csrf_hash()
        ]);
    }

    public function delete_property($id)
    {
        // === Delete property images ===
        $propertyImages = $this->propertyImageModel->where('property_id', $id)->findAll();
        foreach ($propertyImages as $img) {
            $filePath = FCPATH . 'uploads/properties/' . $img['image'];
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
        $this->propertyImageModel->where('property_id', $id)->delete();

        // === Delete master plan images ===
        $masterPlans = $this->masterPlanModel->where('property_id', $id)->findAll();
        foreach ($masterPlans as $plan) {
            $planPath = FCPATH . 'uploads/master_plans/' . $plan['master_plan_image'];
            if (is_file($planPath)) {
                unlink($planPath);
            }
        }
        $this->masterPlanModel->where('property_id', $id)->delete();

        // === Delete floor plans and their images ===
        $floorPlans = $this->floorPlanModel->where('property_id', $id)->findAll();
        foreach ($floorPlans as $plan) {
            $images = $this->floorPlanImageModel->where('floor_plan_id', $plan['id'])->findAll();
            foreach ($images as $img) {
                $imgPath = FCPATH . 'uploads/floor_plans/' . $img['image'];
                if (is_file($imgPath)) {
                    unlink($imgPath);
                }
            }
            $this->floorPlanImageModel->where('floor_plan_id', $plan['id'])->delete();
        }
        $this->floorPlanModel->where('property_id', $id)->delete();
        // Delete Legal Approvals & Files
        $legalApprovals = $this->legalApprovalModel->where('property_id', $id)->findAll();
        foreach ($legalApprovals as $approval) {
            if (!empty($approval['document_file'])) {
                $docPath = FCPATH . 'documents/' . $approval['document_file'];
                if (is_file($docPath)) {
                    unlink($docPath);
                }
            }
        }
        $this->legalApprovalModel->where('property_id', $id)->delete();
        // === Delete Micro Market Documents ===
        $marketDocs = $this->microMarketDocumentModel->where('property_id', $id)->findAll();
        foreach ($marketDocs as $doc) {
            if (!empty($doc['image'])) {
                $docPath = FCPATH . 'uploads/micro_market/' . $doc['image'];
                if (is_file($docPath)) {
                    unlink($docPath);
                }
            }
        }
        $this->microMarketDocumentModel->where('property_id', $id)->delete();

        // === Delete Micro Market Section ===
        $section = $this->microMarketSectionModel->where('property_id', $id)->first();
        if ($section && !empty($section['section_image'])) {
            $imgPath = FCPATH . 'images/' . $section['section_image'];
            if (is_file($imgPath)) {
                unlink($imgPath);
            }
            $this->microMarketSectionModel->delete($section['id']);
        }

        // === Delete Property Amenities ===
        $this->propertyAmenitiesModel->where('property_id', $id)->delete();

        // === Delete Specifications ===
        $this->propertySpecificationsModel->where('property_id', $id)->delete();

        // === Finally delete property ===
        $this->propertyModel->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Property and all related data deleted successfully.']);
    }
    public function delete_floor_plan($id)
    {
        if ($this->request->isAJAX()) {
            try {
                $floorPlan = $this->floorPlanModel->find($id);

                if (!$floorPlan) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Floor plan not found.'
                    ]);
                }

                // Delete associated images
                $images = $this->floorPlanImageModel->where('floor_plan_id', $id)->findAll();

                foreach ($images as $img) {
                    if (!empty($img['image'])) {
                        $filePath = FCPATH . 'uploads/floor_plans/' . $img['image'];
                        if (file_exists($filePath)) {
                            try {
                                unlink($filePath);
                            } catch (\Throwable $e) {
                                log_message('error', 'Error deleting image file: ' . $filePath . ' - ' . $e->getMessage());
                            }
                        }
                    }
                }

                // Delete image records from DB
                $this->floorPlanImageModel->where('floor_plan_id', $id)->delete();

                // Delete the floor plan
                if ($this->floorPlanModel->delete($id)) {
                    return $this->response->setJSON(['success' => true]);
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Failed to delete floor plan.'
                    ])->setStatusCode(400);
                }
            } catch (\Throwable $e) {
                log_message('error', 'Error deleting floor plan: ' . $e->getMessage());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Internal Server Error'
                ])->setStatusCode(500);
            }
        }

        return $this->response->setStatusCode(400)->setJSON([
            'success' => false,
            'message' => 'Invalid request.'
        ]);
    }
    public function view_property_images($id)
    {
        if ($this->request->isAJAX()) {
            $images = $this->propertyImageModel->where('property_id', $id)->findAll();
            return view('admin/property_images_modal', ['images' => $images]);
        }
    }
    public function developers()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;

        $developers = $this->developerModel
            ->orderBy('id', 'DESC')
            ->paginate($perPage, 'group1');

        $pager = $this->developerModel->pager;

        $data = [
            'title' => 'Developers',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/developers',
            'developers' => $developers,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
        ];

        return view('admin/layout/templates', $data);
    }

    public function add_developer()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        // Load models
        $propertyModel = new PropertyModel();
        $assignedPropertyIds = $this->developerModel->select('property_id')->findAll();

        // Extract assigned property IDs
        $assignedIds = array_column($assignedPropertyIds, 'property_id');

        // Fetch properties not already assigned to any developer
        $availableProperties = $propertyModel->whereNotIn('id', $assignedIds)->findAll();

        $data = [
            'title' => 'Developers',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/add_developer',
            'properties' => $availableProperties,
        ];

        return view('admin/layout/templates', $data);
    }


    public function save_developer()
    {
        helper(['form', 'url']);

        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required',
            'established_year' => 'required|numeric|min_length[4]',
            'completed_projects' => 'required',
            'description' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpeg,image/png,image/jpg]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $validation->getErrors()));
        }

        $image = $this->request->getFile('image');
        $imageName = '';

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/developers/', $imageName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'property_id' => $this->request->getPost('property_id'),
            'established_year' => $this->request->getPost('established_year'),
            'completed_projects' => $this->request->getPost('completed_projects'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->developerModel->insert($data)) {
            return redirect()->to('admin/developers')->with('success', 'Developer added successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to save developer.');
        }
    }

    public function edit_developer($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        // Get developer by ID
        $developer = $this->developerModel->find($id);
        if (!$developer) {
            return redirect()->back()->with('error', 'Developer not found.');
        }

        // Get logged-in admin name
        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        // Get all property IDs assigned to developers excluding the current one
        $assignedPropertyIds = $this->developerModel
            ->where('id !=', $id)
            ->select('property_id')
            ->findAll();

        $assignedIds = array_column($assignedPropertyIds, 'property_id');

        // Build property query
        $builder = $this->propertyModel;

        if (!empty($assignedIds)) {
            $builder = $builder->whereNotIn('id', $assignedIds);
        }

        $builder = $builder->orWhere('id', $developer['property_id']);

        $properties = $builder->findAll();

        $data = [
            'title' => 'Edit Developer',
            'name' => $user['username'] ?? 'Admin',
            'developer' => $developer,
            'properties' => $properties,
            'content' => 'admin/edit_developer'
        ];

        return view('admin/layout/templates', $data);
    }



    public function update_developer($id)
    {
        $developer = $this->developerModel->find($id);
        if (!$developer) {
            return redirect()->back()->with('error', 'Developer not found.');
        }

        $rules = [
            'name' => 'required',
            'established_year' => 'required|numeric',
            'completed_projects' => 'required',
            'description' => 'required',
            'property_id' => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $image = $this->request->getFile('image');
        $imageName = $developer['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            if (!empty($developer['image']) && file_exists(FCPATH . 'uploads/developers/' . $developer['image'])) {
                unlink(FCPATH . 'uploads/developers/' . $developer['image']);
            }

            $imageName = $image->getRandomName();
            $image->move('uploads/developers/', $imageName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'property_id' => $this->request->getPost('property_id'),
            'established_year' => $this->request->getPost('established_year'),
            'completed_projects' => $this->request->getPost('completed_projects'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->developerModel->update($id, $data);

        return redirect()->to(base_url('admin/developers'))->with('success', 'Developer updated successfully.');
    }
    public function delete_developer($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
        }

        $developer = $this->developerModel->find($id);
        if (!$developer) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Developer not found']);
        }

        // Delete image from server
        if (!empty($developer['image']) && file_exists(FCPATH . 'uploads/developers/' . $developer['image'])) {
            unlink(FCPATH . 'uploads/developers/' . $developer['image']);
        }

        // Delete record from DB
        if ($this->developerModel->delete($id)) {
            return $this->response->setJSON(['success' => 'Developer deleted successfully']);
        }
    }

}

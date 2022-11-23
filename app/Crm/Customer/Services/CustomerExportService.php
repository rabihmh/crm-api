<?php

namespace Crm\Customer\Services;

use Crm\Customer\Repositories\CustomerRepository;
use Crm\Customer\Services\Export\HtmlExport;
use Crm\Customer\Services\Export\JsonExport;
use Crm\Customer\Services\Export\PdfExport;

class CustomerExportService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function export(string $format)
    {

        $customers = $this->customerRepository->all();
        switch ($format) {
            case 'json':
                $exporter = new JsonExport();
                break;
            case 'html':
                $exporter = new HtmlExport();
                break;
            case 'pdf':
                $exporter = new PdfExport();
                break;
        }
        $exporter->export($customers);
    }

}

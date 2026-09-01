<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class FrontendController extends ShubhController
{
    /**
     * Identity used by the Google / schema.org structured data below.
     */
    protected string $siteName = APP_TITLE;

    protected string $siteDescription = APP_DESCRIPTION;

    /**
     * Path (relative to base_url) of the logo used for the Organization node.
     * Leave empty to drop the logo from the schema.
     */
    protected string $siteLogo = 'assets/themes/frontend/images/logo.png';

    /**
     * Profile URLs Google may link to the Organization: Facebook, X, LinkedIn, ...
     *
     * @var list<string>
     */
    protected array $siteProfiles = [];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->data['title']    = '';
        $this->data['siteName'] = $this->siteName;
        // Current page without index.php — canonical tag and structured data use it.
        $this->data['canonicalUrl'] = base_url(uri_string());

        // Site-wide JSON-LD nodes. Pages add their own with addSchema().
        $this->data['schema'] = [
            $this->organizationSchema(),
            $this->websiteSchema(),
        ];
    }

    /**
     * Append a schema.org node to the JSON-LD graph of the current page.
     *
     * @param array<string, mixed> $schema
     */
    protected function addSchema(array $schema): static
    {
        $this->data['schema'][] = $schema;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    protected function organizationSchema(): array
    {
        $organization = [
            '@type' => 'Organization',
            '@id'   => base_url('#organization'),
            'name'  => $this->siteName,
            'url'   => base_url('/'),
        ];

        if ($this->siteDescription !== '') {
            $organization['description'] = $this->siteDescription;
        }

        if ($this->siteLogo !== '') {
            $organization['logo'] = [
                '@type' => 'ImageObject',
                '@id'   => base_url('#logo'),
                'url'   => base_url($this->siteLogo),
            ];
            $organization['image'] = ['@id' => base_url('#logo')];
        }

        if ($this->siteProfiles !== []) {
            $organization['sameAs'] = array_values($this->siteProfiles);
        }

        return $organization;
    }

    /**
     * @return array<string, mixed>
     */
    protected function websiteSchema(): array
    {
        $website = [
            '@type'     => 'WebSite',
            '@id'       => base_url('#website'),
            'url'       => base_url('/'),
            'name'      => $this->siteName,
            'publisher' => ['@id' => base_url('#organization')],
            'inLanguage' => 'en',
        ];

        if ($this->siteDescription !== '') {
            $website['description'] = $this->siteDescription;
        }

        return $website;
    }

    /**
     * BreadcrumbList node: ['Home' => '/', 'About' => 'about'].
     *
     * @param array<string, string> $crumbs
     *
     * @return array<string, mixed>
     */
    protected function breadcrumbSchema(array $crumbs): array
    {
        $items    = [];
        $position = 1;

        foreach ($crumbs as $name => $uri) {
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => $name,
                'item'     => base_url($uri),
            ];
        }

        return [
            '@type'           => 'BreadcrumbList',
            '@id'             => current_url() . '#breadcrumb',
            'itemListElement' => $items,
        ];
    }
}

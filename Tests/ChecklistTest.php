<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ChecklistTest extends TestCase {
    protected $client;

    protected $link = '/api/checklist';

    protected function setUp(): void {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://api.local:44'
        ]);
    }

    public function testLengthContentEqualNeed(): void {
        $response = $this->client->post($this->link, [
            'form_params' => [
                'content'    => 'banana jsdlfjsd banana sd fds sdf sf sdf'
            ]
        ]);
    
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody()->getContents(), true);        
        $this->assertEquals(true, $data['status']);
    }

    public function testLengthContentLessNeed(): void {
        $response = $this->client->post($this->link, [
            'form_params' => [
                'content'    => 'banana jsdlfjsd banana sd'
            ]
        ]);
    
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody()->getContents(), true);        
        
        $this->assertEquals(true, $data['status']);
    }

    public function testAveragekeywordsDensity(): void {
        $response = $this->client->post($this->link, [
            'form_params' => [
                'content'    => 'banana jsdlfjsd banana sd dsf sfd'
            ]
        ]);
    
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody()->getContents(), true);        
        $this->assertEquals(true, $data['status']);
        // var_dump($data);
        $this->assertEquals("0.17", $data['average keywords density']);
    }
}
<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Blog\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Seed editable legal pages.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'terms-and-conditions',
                'title' => 'Terms & Conditions',
                'content' => <<<'HTML'
<h2 class="legal-effective-date">Effective Date: Wednesday, 18 June 2025</h2>
<p><strong>Website:</strong> <a href="https://creavibe.com">https://creavibe.com</a></p>
<p><strong>Contact Email:</strong> <a href="mailto:support@creavibe.com">support@creavibe.com</a></p>
<p><strong>Jurisdiction:</strong> State of Punjab, Pakistan</p>
<p>Welcome to Creavibe (<a href="https://creavibe.com">https://creavibe.com</a>), an online guest posting and link-building marketplace operated by Creavibe. These Terms and Conditions govern your access to and use of our website, services, and platform. By accessing or using Creavibe, you agree to comply with these Terms and Conditions.</p>
<h2>1. Acceptance Of Terms</h2>
<p>By registering on or using the Creavibe platform, you confirm that you have read, understood, and agree to be bound by these Terms. If you do not accept these Terms, you must immediately discontinue use of the site.</p>
<h2>2. Definitions</h2>
<p><strong>Publisher:</strong> A user offering content placement services or digital media space.</p>
<p><strong>Advertiser:</strong> A user purchasing placements, backlinks, or guest posts for promotional purposes.</p>
<p><strong>Listing:</strong> A media offer created by a Publisher for potential buyers.</p>
<p><strong>Order:</strong> A confirmed agreement between an Advertiser and a Publisher for a specific placement.</p>
<h2>3. User Accounts</h2>
<p>To use certain features of Creavibe, you must create an account with accurate, current information. You are responsible for maintaining confidentiality of your credentials and all activities under your account.</p>
<h2>4. Services Offered</h2>
<p>Creavibe is a digital marketplace facilitating collaboration between Publishers and Advertisers for:</p>
<ul>
<li>Creating and managing user profiles</li>
<li>Listing and browsing guest post opportunities</li>
<li>Ordering content placements or backlinks</li>
<li>Uploading or submitting content for placement</li>
<li>Tracking orders and payment history</li>
<li>Managing communication between users</li>
<li>Accessing newsletters and updates</li>
</ul>
<p>All transactions are conducted in U.S. Dollars (USD) unless otherwise specified.</p>
<h2>5. Payments</h2>
<ul>
<li>Publishers set the prices for their listings.</li>
<li>Payments are made through approved gateways such as PayPal, Payoneer, Crypto, Stripe and bank transfers.</li>
<li>Creavibe may apply a platform service fee, included in the total price shown to the Advertiser.</li>
<li>All financial transactions are securely processed through third-party services.</li>
</ul>
<h2>6. Content Guidelines</h2>
<p>All content provided or requested must be legal and not infringe on copyrights or third-party rights, avoid spam and misleading information, and be suitable for publishing without violating laws or ethical guidelines.</p>
<p>Creavibe reserves the right to reject or remove any content that violates these rules.</p>
<h2>7. Rights And Responsibilities</h2>
<ul>
<li>Publishers must have full rights to offer and publish the content or website listings.</li>
<li>Advertisers must ensure their submitted content meets platform standards.</li>
<li>Users are fully responsible for legal consequences arising from their published or submitted content.</li>
<li>Creavibe disclaims liability for copyright violations or legal disputes between users.</li>
</ul>
<h2>8. Privacy And Data Protection</h2>
<p>We respect your privacy. For detailed information about how we collect, use, and protect your data, refer to our <a href="/privacy-policy">Privacy Policy</a>.</p>
<h2>9. Refund Policy</h2>
<p>Refunds may be granted under the following conditions:</p>
<p><strong>Order Not Completed:</strong> If a Publisher fails to deliver as agreed, funds will be returned to the buyer's wallet.</p>
<p><strong>Content Dispute:</strong> If the delivered content significantly differs from the order and the Publisher refuses revision, a refund may be issued.</p>
<p><strong>Order Confirmed:</strong> Once an order is marked as complete and approved, no refund will be issued.</p>
<p>All refunds are issued to the internal wallet balance for future use.</p>
<h2>10. Disclaimer And Limitations Of Liability</h2>
<p>Creavibe is provided "as is" without warranties of any kind. We do not guarantee continuous access to any specific site or media, permanent indexing or ranking by search engines, or traffic consistency from placements.</p>
<h2>11. Modifications To Terms</h2>
<p>Creavibe reserves the right to update or change these Terms at any time. Continued use after changes implies acceptance. You will be notified via email or a website banner of any significant changes.</p>
<h2>12. Governing Law</h2>
<p>These Terms and Conditions shall be governed by and interpreted in accordance with the laws of the State of Punjab, without regard to conflict of law principles.</p>
<h2>13. Contact</h2>
<p>If you have any questions or concerns, please contact us at:</p>
<p>Email: <strong>support@creavibe.com</strong></p>
<p>Website: <a href="https://creavibe.com">https://creavibe.com</a></p>
HTML,
            ],
            [
                'slug' => 'privacy-policy',
                'title' => 'Privacy Policy',
                'content' => <<<'HTML'
<h2 class="legal-effective-date">Effective Date: Wednesday, 18 June 2025</h2>
<p><strong>Website:</strong> <a href="https://creavibe.com">https://creavibe.com</a></p>
<p><strong>Contact Email:</strong> <a href="mailto:support@creavibe.com">support@creavibe.com</a></p>
<p><strong>Jurisdiction:</strong> State of Punjab, Pakistan</p>
<p>This Privacy Policy outlines how <strong>Creavibe</strong> ("we", "our", "us") collects, uses, and protects your information when you visit or interact with our platform <a href="https://creavibe.com">https://creavibe.com</a> (the "Service").</p>
<p>By accessing or using our platform, you agree to the terms of this Privacy Policy. If you do not agree, please do not use our services.</p>
<h2>1. Changes To This Policy</h2>
<p>We reserve the right to revise this Privacy Policy at any time without prior notice. Updated policies will be posted on this page and will become effective 30 days after publication. Your continued use of our platform signifies your acceptance of the updated terms.</p>
<h2>2. Information We Collect</h2>
<p>We collect and process the following personal data:</p>
<ul>
<li>First Name</li>
<li>Last Name</li>
<li>Email Address</li>
<li>IP Address</li>
<li>Communication history</li>
<li>Wallet or transaction records (non-sensitive)</li>
</ul>
<p>We may also collect anonymous usage data for analytics and service improvement purposes.</p>
<h2>3. How We Use Your Information</h2>
<p>Your data is used for:</p>
<ul>
<li>Account management and login security</li>
<li>Customer support and feedback</li>
<li>Order and transaction processing</li>
<li>Marketing and promotional activities</li>
<li>Internal analytics and performance monitoring</li>
<li>Legal compliance and fraud prevention</li>
<li>Dispute resolution and communication between users</li>
</ul>
<p>If we intend to use your data for a new purpose, we will seek your explicit consent.</p>
<h2>4. Sharing Your Information</h2>
<p>We do not sell or rent your personal data. However, your information may be shared with trusted third parties under the following conditions:</p>
<ul>
<li><strong>Analytics Tools:</strong> For site performance and user behavior analysis</li>
<li><strong>Legal Compliance:</strong> To comply with applicable Pakistani laws, court orders, or legal processes</li>
<li><strong>Platform Protection:</strong> To enforce our policies or respond to any legal claims</li>
<li><strong>Business Transfer:</strong> In case of merger, acquisition, or asset sale, your data may be transferred</li>
</ul>
<p>All third parties are bound by strict confidentiality and data protection agreements.</p>
<h2>5. Retention Of Data</h2>
<p>We retain your data for as long as necessary to provide services and comply with legal obligations:</p>
<ul>
<li>User data is retained for 90 days to 2 years after inactivity</li>
<li>Transactional and billing records may be kept longer for tax, fraud, or dispute resolution</li>
</ul>
<p>Anonymous, non-personal information may be stored indefinitely for analytical purposes.</p>
<h2>6. Your Rights</h2>
<p>Under the laws of Pakistan, you have the right to:</p>
<ul>
<li>Access or correct your personal information</li>
<li>Request deletion or restriction of data</li>
<li>Object to specific types of processing</li>
<li>Withdraw consent where applicable</li>
<li>File a complaint with the Pakistan Telecommunication Authority (PTA) or other legal authority</li>
</ul>
<p>To exercise your rights, contact us at support@creavibe.com. We aim to respond within 15 working days.</p>
<h2>7. Cookies And Tracking Technologies</h2>
<p>We use cookies and similar technologies for session management, remembering preferences, improving user experience, and anonymous usage analytics.</p>
<h2>8. Data Security</h2>
<p>We take reasonable technical and organizational measures to protect your data from unauthorized access, loss, misuse, alteration, malware, or phishing attacks.</p>
<p>However, no digital system is 100% secure. Any data transmission to Creavibe is done at your own risk.</p>
<h2>9. Third-Party Links</h2>
<p>Our platform may contain links to third-party websites or services. We are not responsible for their privacy practices and encourage you to read their policies separately.</p>
<h2>10. Grievance Officer / Data Protection Officer</h2>
<p>If you have any concerns or complaints regarding this policy or the use of your data, please contact:</p>
<h3>Grievance Officer</h3>
<p>Creavibe - Legal Department</p>
<p>Email: <strong>support@creavibe.com</strong></p>
<p>Jurisdiction: State of Punjab, Pakistan</p>
<p>We will address your concerns in compliance with Pakistan's data protection principles.</p>
<p><strong>Note:</strong> This Privacy Policy is governed under the laws of Pakistan, particularly the State of Punjab. Use of our platform indicates your consent to our policies and practices.</p>
HTML,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'title' => $page['title'],
                    'content' => $page['content'],
                    'is_active' => true,
                ]
            );
        }
    }
}

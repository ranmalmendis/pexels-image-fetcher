# Pexels Image Fetcher

The Pexels Image Fetcher is a WordPress plugin designed to dynamically fetch and display images from Pexels.com based on specified topics. This plugin integrates seamlessly with the Pexels API, allowing WordPress site administrators to enrich their website with high-quality, relevant photographs without the need for manual image sourcing.

## Features

- **Dynamic Image Fetching**: Automatically retrieves images from Pexels based on user-defined topics.
- **Shortcode Integration**: Easily implementable within posts and pages using a simple shortcode.
- **Customizable Image Count**: Users can specify the number of images they wish to display.
- **Responsive Design**: Ensures compatibility and optimal display across various devices.
- **API Key Configuration**: Includes a settings page for easy Pexels API key input and management.
- **Internationalization Ready**: Prepared for translation, making it accessible for a wide range of users.

## Installation

1. **Download the Plugin**:
   - Download the `pexels-image-fetcher.zip` file from the WordPress Plugin Repository or the GitHub repository.

2. **Upload and Activate**:
   - Navigate to your WordPress dashboard, go to `Plugins` > `Add New` > `Upload Plugin`.
   - Choose the downloaded `.zip` file and click `Install Now`.
   - Once installed, activate 'Pexels Image Fetcher' from your Plugins page.

3. **API Key Configuration**:
   - Obtain a Pexels API key by registering at [Pexels Developers](https://www.pexels.com/api/new/).
   - In the WordPress dashboard, go to `Settings` > `Pexels Image Fetcher`.
   - Enter your Pexels API key and save the changes.

## Usage

To display images, use the shortcode `[pexels_images]` in your posts or pages. The shortcode can be customized with the following attributes:

- `topic`: The subject or theme of the desired images (e.g., `nature`, `technology`). Default is `nature`.
- `num_images`: The number of images to display. Default is `10`.

**Example**: `[pexels_images topic="cityscape" num_images="5"]`

## Frequently Asked Questions

**Q**: Where can I find my Pexels API key?  
**A**: Register as a developer on Pexels and generate an API key on your Pexels dashboard.

**Q**: Is there a limit to the number of images I can display?  
**A**: The plugin allows you to set the desired number of images, but keep in mind the Pexels API's rate limits and your server's performance.

**Q**: Can I use this plugin on commercial websites?  
**A**: Yes, but ensure adherence to Pexels' photo licensing terms.

## Screenshots

1. Pexels API settings page in WordPress.
2. Example of images displayed on a page using the shortcode.

## Changelog

**1.0.0**
- Initial release.

## License

This plugin is licensed under the GNU General Public License v2.0 or later.

## Contributions

Contributions, issues, and feature requests are welcome on our [GitHub page](https://github.com/yourgithubusername/pexels-image-fetcher).

---

This plugin is not affiliated with or endorsed by Pexels.com. All images are provided by Pexels and are subject to Pexels' terms of use.

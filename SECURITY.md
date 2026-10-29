# Security policy

## Supported version

Security fixes are applied to the latest release and the current `main` branch. Older installations should be upgraded.

## Reporting a vulnerability

Do not publish exploit details in a public issue. Use the repository's private GitHub Security Advisory reporting flow so the maintainer can investigate before disclosure.

## Deployment guidance

- Keep WordPress core and this plugin updated.
- Allow model URLs only from origins approved by the site owner and reflect that policy in the site's Content Security Policy.
- Prefer models hosted by the same site when visitor privacy or third-party availability is important.
- Test plugin updates in a non-production WordPress environment.
- Retain backups and verify restoration before changing published model content.
- Monitor browser and server errors related to failed model or script loading.

The plugin bundles `@google/model-viewer` 4.1.0 locally. Its license is stored in `assets/js/model-viewer.LICENSE.txt`, and the plugin does not require a runtime JavaScript CDN.

## ENS scope

This repository alone cannot establish ENS conformity. Applicability, system category, risk analysis, statement of applicability, operational controls, suppliers, logging, backup, recovery, and incident response must be documented and validated for the complete WordPress service.

# Multi-stage build for production-ready container
FROM registry.access.redhat.com/ubi9/php-83:latest

# Metadata
LABEL maintainer="MyMenu - Monthly Meal Planner" \
      version="2.0.0" \
      description="MyMenu - Modern monthly meal planning application with 91+ recipes, vegetarian options, and smart meal distribution"

# Set working directory
WORKDIR /opt/app-root/src

# Install system dependencies
USER root
RUN dnf install -y \
    httpd \
    php-fpm \
    php-json \
    && dnf clean all \
    && rm -rf /var/cache/dnf

# Configure Apache for security
RUN sed -i 's/^ServerTokens .*/ServerTokens Prod/' /etc/httpd/conf/httpd.conf && \
    sed -i 's/^ServerSignature .*/ServerSignature Off/' /etc/httpd/conf/httpd.conf && \
    echo 'Header always set X-Content-Type-Options "nosniff"' >> /etc/httpd/conf/httpd.conf && \
    echo 'Header always set X-Frame-Options "SAMEORIGIN"' >> /etc/httpd/conf/httpd.conf && \
    echo 'Header always set X-XSS-Protection "1; mode=block"' >> /etc/httpd/conf/httpd.conf

# Copy application files
COPY --chown=1001:0 index.php ./
COPY --chown=1001:0 refresh-meal.php ./
COPY --chown=1001:0 *.json ./
COPY --chown=1001:0 images/ ./images/
COPY --chown=1001:0 README.md ./

# Set proper permissions
RUN chown -R 1001:0 /opt/app-root/src && \
    chmod -R g=u /opt/app-root/src && \
    chmod 755 /opt/app-root/src

# Switch back to non-root user
USER 1001

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
  CMD curl -f http://localhost:8080/ || exit 1

# Expose port
EXPOSE 8080

# Start PHP server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/opt/app-root/src"]

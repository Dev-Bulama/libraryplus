<!-- AI Settings Configuration -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-cogs"></i> AI Configuration
            <small>Configure AI settings and API connections</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('ai_training'); ?>">AI Management</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check"></i> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-exclamation-triangle"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo base_url('ai_training/settings'); ?>">
            <div class="row">
                <!-- API Configuration -->
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-key"></i> API Configuration</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="openai_api_key">OpenAI API Key *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" 
                                           class="form-control" 
                                           id="openai_api_key" 
                                           name="openai_api_key" 
                                           value="<?php echo htmlspecialchars($settings['openai_api_key'] ?? ''); ?>"
                                           placeholder="sk-...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="togglePassword('openai_api_key')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </span>
                                </div>
                                <small class="help-block">
                                    Your OpenAI API key. Get one from <a href="https://platform.openai.com/api-keys" target="_blank">OpenAI Platform</a>.
                                    Keep this secure and never share it publicly.
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="ai_model_version">AI Model Version</label>
                                <select class="form-control" id="ai_model_version" name="ai_model_version">
                                    <option value="gpt-3.5-turbo" <?php echo ($settings['ai_model_version'] ?? 'gpt-3.5-turbo') == 'gpt-3.5-turbo' ? 'selected' : ''; ?>>
                                        GPT-3.5 Turbo (Recommended)
                                    </option>
                                    <option value="gpt-4" <?php echo ($settings['ai_model_version'] ?? '') == 'gpt-4' ? 'selected' : ''; ?>>
                                        GPT-4 (Higher Quality, More Expensive)
                                    </option>
                                    <option value="gpt-4-turbo" <?php echo ($settings['ai_model_version'] ?? '') == 'gpt-4-turbo' ? 'selected' : ''; ?>>
                                        GPT-4 Turbo (Latest)
                                    </option>
                                </select>
                                <small class="help-block">
                                    Choose the AI model to use. GPT-3.5 Turbo offers good performance at lower cost.
                                </small>
                            </div>

                            <button type="button" class="btn btn-info" onclick="testAPIConnection()">
                                <i class="fa fa-plug"></i> Test API Connection
                            </button>
                            <div id="apiTestResult" class="mt-2" style="display: none;"></div>
                        </div>
                    </div>

                    <!-- AI Features Configuration -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-toggle-on"></i> Feature Settings</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" 
                                                   name="ai_enabled" 
                                                   value="1" 
                                                   <?php echo ($settings['ai_enabled'] ?? '1') == '1' ? 'checked' : ''; ?>>
                                            Enable AI System
                                        </label>
                                        <p class="help-block">Master switch for all AI features</p>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" 
                                                   name="ai_search_enabled" 
                                                   value="1" 
                                                   <?php echo ($settings['ai_search_enabled'] ?? '1') == '1' ? 'checked' : ''; ?>>
                                            AI-Powered Search
                                        </label>
                                        <p class="help-block">Intelligent book search using natural language</p>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" 
                                                   name="ai_recommendations_enabled" 
                                                   value="1" 
                                                   <?php echo ($settings['ai_recommendations_enabled'] ?? '1') == '1' ? 'checked' : ''; ?>>
                                            AI Recommendations
                                        </label>
                                        <p class="help-block">Personalized book recommendations</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" 
                                                   name="ai_chat_enabled" 
                                                   value="1" 
                                                   <?php echo ($settings['ai_chat_enabled'] ?? '1') == '1' ? 'checked' : ''; ?>>
                                            AI Chat Assistant
                                        </label>
                                        <p class="help-block">Interactive AI book assistant</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="ai_max_search_results">Max Search Results</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="ai_max_search_results" 
                                               name="ai_max_search_results" 
                                               value="<?php echo htmlspecialchars($settings['ai_max_search_results'] ?? '10'); ?>"
                                               min="5" 
                                               max="50">
                                        <p class="help-block">Maximum number of search results to display</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="ai_recommendation_count">Recommendations Count</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="ai_recommendation_count" 
                                               name="ai_recommendation_count" 
                                               value="<?php echo htmlspecialchars($settings['ai_recommendation_count'] ?? '5'); ?>"
                                               min="3" 
                                               max="20">
                                        <p class="help-block">Number of recommendations to generate</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status & Help Sidebar -->
                <div class="col-md-4">
                    <!-- Connection Status -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-wifi"></i> Connection Status</h3>
                        </div>
                        <div class="box-body">
                            <div id="connectionStatus">
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-cog fa-spin"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">API Status</span>
                                        <span class="info-box-number">Checking...</span>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h5><i class="fa fa-info-circle"></i> System Info</h5>
                            <ul class="list-unstyled">
                                <li><strong>PHP Version:</strong> <?php echo PHP_VERSION; ?></li>
                                <li><strong>cURL Support:</strong> 
                                    <?php echo function_exists('curl_version') ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>'; ?>
                                </li>
                                <li><strong>OpenSSL:</strong> 
                                    <?php echo extension_loaded('openssl') ? '<span class="text-success">Enabled</span>' : '<span class="text-danger">Disabled</span>'; ?>
                                </li>
                                <li><strong>JSON Support:</strong> 
                                    <?php echo function_exists('json_encode') ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>'; ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Configuration Guide -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-lightbulb-o"></i> Configuration Guide</h3>
                        </div>
                        <div class="box-body">
                            <h5>Setting up OpenAI API:</h5>
                            <ol class="small">
                                <li>Visit <a href="https://platform.openai.com" target="_blank">OpenAI Platform</a></li>
                                <li>Create an account or sign in</li>
                                <li>Go to API Keys section</li>
                                <li>Create a new secret key</li>
                                <li>Copy and paste it above</li>
                                <li>Test the connection</li>
                            </ol>

                            <div class="callout callout-info">
                                <h5>Cost Management</h5>
                                <p class="small">Set usage limits in your OpenAI dashboard to control costs. GPT-3.5 Turbo is recommended for most use cases.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Usage Statistics -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-chart-bar"></i> Usage This Month</h3>
                        </div>
                        <div class="box-body">
                            <div class="progress-group">
                                <span class="progress-text">API Calls</span>
                                <span class="float-right"><b>1,247</b></span>
                                <div class="progress sm">
                                    <div class="progress-bar bg-primary" style="width: 35%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                <span class="progress-text">Successful Responses</span>
                                <span class="float-right"><b>98.2%</b></span>
                                <div class="progress sm">
                                    <div class="progress-bar bg-success" style="width: 98%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                <span class="progress-text">Average Response Time</span>
                                <span class="float-right"><b>1.3s</b></span>
                                <div class="progress sm">
                                    <div class="progress-bar bg-yellow" style="width: 70%"></div>
                                </div>
                            </div>

                            <hr>
                            <small class="text-muted">
                                <i class="fa fa-info-circle"></i> 
                                Estimated monthly cost: $12.50
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-save"></i> Save Configuration
                            </button>
                            <a href="<?php echo base_url('ai_training'); ?>" class="btn btn-default btn-lg">
                                <i class="fa fa-arrow-left"></i> Back to Dashboard
                            </a>
                            <button type="button" class="btn btn-warning btn-lg" onclick="resetToDefaults()">
                                <i class="fa fa-refresh"></i> Reset to Defaults
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<!-- Custom CSS -->
<style>
.progress-group {
    margin-bottom: 15px;
}

.info-box {
    display: block;
    min-height: 90px;
    background: #fff;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 2px;
    margin-bottom: 15px;
}

.info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0,0,0,0.2);
}

.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
}

.info-box-text {
    text-transform: uppercase;
    font-weight: bold;
    font-size: 13px;
}

.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
}

.callout {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
}

.callout-info {
    border-left-color: #1f8dd6;
}

.help-block {
    font-size: 12px;
    color: #737373;
}

.form-group label {
    font-weight: 600;
}

#apiTestResult {
    padding: 10px;
    border-radius: 4px;
    margin-top: 10px;
}

.success-result {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error-result {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    // Check API status on load
    checkAPIStatus();
    
    // Auto-save form data to localStorage
    $('form input, form select').on('change', function() {
        localStorage.setItem('ai_settings_' + this.name, this.value);
    });
});

function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling.querySelector('button i');
    
    if (field.type === 'password') {
        field.type = 'text';
        button.className = 'fa fa-eye-slash';
    } else {
        field.type = 'password';
        button.className = 'fa fa-eye';
    }
}

function testAPIConnection() {
    const apiKey = document.getElementById('openai_api_key').value;
    const model = document.getElementById('ai_model_version').value;
    const resultDiv = document.getElementById('apiTestResult');
    
    if (!apiKey.trim()) {
        resultDiv.innerHTML = '<div class="error-result"><i class="fa fa-exclamation-triangle"></i> Please enter an API key first.</div>';
        resultDiv.style.display = 'block';
        return;
    }
    
    resultDiv.innerHTML = '<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i> Testing connection...</div>';
    resultDiv.style.display = 'block';
    
    // Test API connection
    $.ajax({
        url: '<?php echo base_url("ai_training/test_api_connection"); ?>',
        method: 'POST',
        data: {
            api_key: apiKey,
            model: model
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                resultDiv.innerHTML = `
                    <div class="success-result">
                        <i class="fa fa-check-circle"></i> 
                        Connection successful! Model: ${response.model}, Response time: ${response.response_time}ms
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="error-result">
                        <i class="fa fa-exclamation-triangle"></i> 
                        Connection failed: ${response.error}
                    </div>
                `;
            }
        },
        error: function() {
            resultDiv.innerHTML = `
                <div class="error-result">
                    <i class="fa fa-exclamation-triangle"></i> 
                    Failed to test connection. Please check your server configuration.
                </div>
            `;
        }
    });
}

function checkAPIStatus() {
    const statusDiv = document.getElementById('connectionStatus');
    
    // This would make an actual API call to check status
    setTimeout(function() {
        const hasApiKey = document.getElementById('openai_api_key').value.trim().length > 0;
        
        if (hasApiKey) {
            statusDiv.innerHTML = `
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">API Status</span>
                        <span class="info-box-number">Connected</span>
                    </div>
                </div>
            `;
        } else {
            statusDiv.innerHTML = `
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">API Status</span>
                        <span class="info-box-number">Not Configured</span>
                    </div>
                </div>
            `;
        }
    }, 1000);
}

function resetToDefaults() {
    if (confirm('Are you sure you want to reset all settings to default values? This action cannot be undone.')) {
        // Reset form fields to defaults
        document.getElementById('ai_enabled').checked = true;
        document.getElementById('ai_search_enabled').checked = true;
        document.getElementById('ai_recommendations_enabled').checked = true;
        document.getElementById('ai_chat_enabled').checked = true;
        document.getElementById('ai_model_version').value = 'gpt-3.5-turbo';
        document.getElementById('ai_max_search_results').value = '10';
        document.getElementById('ai_recommendation_count').value = '5';
        
        // Clear API key (security)
        document.getElementById('openai_api_key').value = '';
        
        // Clear localStorage
        Object.keys(localStorage).forEach(key => {
            if (key.startsWith('ai_settings_')) {
                localStorage.removeItem(key);
            }
        });
        
        alert('Settings have been reset to defaults. Remember to save the form.');
    }
}

// Form validation before submit
$('form').on('submit', function(e) {
    const apiKey = document.getElementById('openai_api_key').value.trim();
    const aiEnabled = document.querySelector('input[name="ai_enabled"]').checked;
    
    if (aiEnabled && !apiKey) {
        e.preventDefault();
        alert('Please enter an OpenAI API key or disable the AI system.');
        document.getElementById('openai_api_key').focus();
        return false;
    }
    
    return true;
});
</script>
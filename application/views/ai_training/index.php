<!-- AI Training Dashboard -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-brain"></i> AI Management Dashboard
            <small>Train and configure your AI assistant</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">AI Management</li>
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

        <!-- AI Status Row -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo number_format($training_stats['total_books'] ?? 0); ?></h3>
                        <p>Total Books</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo number_format($training_stats['total_searches'] ?? 0); ?></h3>
                        <p>AI Searches</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo number_format($training_stats['total_recommendations'] ?? 0); ?></h3>
                        <p>Recommendations</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-heart"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo number_format($training_stats['trained_books'] ?? 0); ?></h3>
                        <p>Training Data Sets</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-bolt"></i> Quick Actions</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="<?php echo base_url('ai_training/train_books'); ?>" class="btn btn-primary btn-block btn-lg">
                                    <i class="fa fa-magic"></i><br>
                                    Train AI with Books
                                </a>
                                <p class="text-center small text-muted mt-2">Process all books for AI training</p>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo base_url('ai_training/upload_training_data'); ?>" class="btn btn-success btn-block btn-lg">
                                    <i class="fa fa-upload"></i><br>
                                    Upload Training Data
                                </a>
                                <p class="text-center small text-muted mt-2">Upload CSV, JSON, or text files</p>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo base_url('ai_training/settings'); ?>" class="btn btn-warning btn-block btn-lg">
                                    <i class="fa fa-cogs"></i><br>
                                    AI Settings
                                </a>
                                <p class="text-center small text-muted mt-2">Configure API keys and parameters</p>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo base_url('ai_training/analytics'); ?>" class="btn btn-info btn-block btn-lg">
                                    <i class="fa fa-chart-line"></i><br>
                                    View Analytics
                                </a>
                                <p class="text-center small text-muted mt-2">Monitor AI performance metrics</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI Test Console -->
        <div class="row">
            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-terminal"></i> AI Test Console</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form id="aiTestForm">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Test Type</label>
                                        <select name="test_type" id="testType" class="form-control">
                                            <option value="search">AI Search</option>
                                            <option value="chat">AI Chat</option>
                                            <option value="recommendation">Recommendations</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Test Query</label>
                                        <input type="text" name="test_query" id="testQuery" class="form-control" 
                                               placeholder="Enter your test query...">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-play"></i> Run Test
                            </button>
                        </form>

                        <div id="testResults" class="mt-3" style="display: none;">
                            <h5>Test Results:</h5>
                            <div class="well" id="testOutput"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info-circle"></i> AI Status</h3>
                    </div>
                    <div class="box-body">
                        <div class="info-box-content">
                            <div class="progress-group">
                                <span class="progress-text">AI Training Progress</span>
                                <span class="float-right"><b>75%</b></span>
                                <div class="progress sm">
                                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                                </div>
                            </div>
                            
                            <div class="progress-group">
                                <span class="progress-text">Search Accuracy</span>
                                <span class="float-right"><b>92%</b></span>
                                <div class="progress sm">
                                    <div class="progress-bar bg-success" style="width: 92%"></div>
                                </div>
                            </div>
                            
                            <div class="progress-group">
                                <span class="progress-text">User Satisfaction</span>
                                <span class="float-right"><b>87%</b></span>
                                <div class="progress sm">
                                    <div class="progress-bar bg-warning" style="width: 87%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Health -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-heartbeat"></i> System Health</h3>
                    </div>
                    <div class="box-body">
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa fa-circle text-success"></i> API Connection
                                <span class="pull-right text-success">Online</span>
                            </li>
                            <li>
                                <i class="fa fa-circle text-success"></i> Database
                                <span class="pull-right text-success">Healthy</span>
                            </li>
                            <li>
                                <i class="fa fa-circle text-warning"></i> Training Queue
                                <span class="pull-right text-warning">Processing</span>
                            </li>
                            <li>
                                <i class="fa fa-circle text-success"></i> Search Engine
                                <span class="pull-right text-success">Active</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-history"></i> Recent Training Activity</h3>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($recent_training)): ?>
                            <ul class="timeline timeline-inverse">
                                <?php foreach (array_slice($recent_training, 0, 5) as $training): ?>
                                    <li>
                                        <i class="fa fa-graduation-cap bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time">
                                                <i class="fa fa-clock-o"></i> 
                                                <?php echo date('M j, Y H:i', strtotime($training->created_at)); ?>
                                            </span>
                                            <h3 class="timeline-header">
                                                Training Data: <?php echo ucfirst($training->data_type ?? 'Unknown'); ?>
                                            </h3>
                                            <div class="timeline-body">
                                                Status: 
                                                <span class="label label-<?php echo $training->status == 'processed' ? 'success' : ($training->status == 'failed' ? 'danger' : 'warning'); ?>">
                                                    <?php echo ucfirst($training->status); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">No recent training activity.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-chart-bar"></i> Performance Metrics</h3>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($performance_metrics)): ?>
                            <canvas id="performanceChart" width="400" height="200"></canvas>
                        <?php else: ?>
                            <div class="callout callout-info">
                                <h4>Analytics Dashboard</h4>
                                <p>Performance metrics will appear here once you have sufficient AI activity. Start by training your AI with book data and encouraging users to try the AI search features.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Custom CSS -->
<style>
.small-box {
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.small-box:hover {
    transform: translateY(-5px);
}

.btn-lg {
    padding: 20px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-lg i {
    font-size: 2rem;
    display: block;
    margin-bottom: 10px;
}

.progress-group {
    margin-bottom: 15px;
}

.timeline-item {
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

#testResults {
    margin-top: 20px;
}

#testOutput {
    background: #f4f4f4;
    border-left: 4px solid #007bff;
    padding: 15px;
    border-radius: 5px;
    white-space: pre-wrap;
    font-family: monospace;
}

.info-box-content {
    padding: 0;
}

.callout {
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
}

.callout-info {
    border-left-color: #1f8dd6;
}

.callout h4 {
    margin-top: 0;
    margin-bottom: 5px;
}
</style>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    // AI Test Form
    $('#aiTestForm').on('submit', function(e) {
        e.preventDefault();
        
        const testType = $('#testType').val();
        const testQuery = $('#testQuery').val();
        
        if (!testQuery.trim()) {
            alert('Please enter a test query.');
            return;
        }
        
        $('#testResults').hide();
        $('#testOutput').html('<i class="fa fa-spinner fa-spin"></i> Testing AI...');
        $('#testResults').show();
        
        $.ajax({
            url: '<?php echo base_url("ai_training/test_ai"); ?>',
            method: 'POST',
            data: {
                test_type: testType,
                test_query: testQuery
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let output = `Test Type: ${response.test_type}\n`;
                    output += `Query: ${response.query}\n`;
                    output += `Result: ${JSON.stringify(response.result, null, 2)}`;
                    $('#testOutput').html(output);
                } else {
                    $('#testOutput').html(`Error: ${response.error}`);
                }
            },
            error: function() {
                $('#testOutput').html('Error: Failed to connect to AI service.');
            }
        });
    });
    
    // Sample queries for different test types
    $('#testType').on('change', function() {
        const sampleQueries = {
            'search': 'Books about space exploration',
            'chat': 'What are some good mystery novels?',
            'recommendation': 'I like fantasy and adventure books'
        };
        
        $('#testQuery').attr('placeholder', sampleQueries[$(this).val()]);
    });
    
    // Auto-refresh system health every 30 seconds
    setInterval(function() {
        // This would check system health via AJAX in a real implementation
        console.log('Checking system health...');
    }, 30000);
});

// Initialize performance chart if data exists
<?php if (!empty($performance_metrics)): ?>
const ctx = document.getElementById('performanceChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode(array_column($performance_metrics['search_stats'] ?? [], 'date')); ?>,
        datasets: [{
            label: 'Daily Searches',
            data: <?php echo json_encode(array_column($performance_metrics['search_stats'] ?? [], 'searches')); ?>,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'AI Search Activity (Last 7 Days)'
            }
        }
    }
});
<?php endif; ?>
</script>